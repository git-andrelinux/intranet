import ctEvents from 'ct-events'
import { handleSingleVariableFor } from 'customizer-sync-helpers'
import { getValueFromInput } from '../../options/helpers/get-value-from-input'
import $ from 'jquery'
import { __ } from 'ct-i18n'

import {
	getOriginalId,
	shortenItemId,
} from '../../customizer/panels-builder/placements/helpers'

function isFunction(functionToCheck) {
	return (
		functionToCheck &&
		{}.toString.call(functionToCheck) === '[object Function]'
	)
}

const headerVariableDescriptors = {}
const footerVariableDescriptors = {}

const handleItemChangeFor = (args = {}) => {
	let {
		panelType,
		variableDescriptors,
		itemId,
		optionId,
		optionValue,
		values,
	} = {
		panelType: 'header',
		variableDescriptors: {},
		itemId: '',
		optionId: '',
		optionValue: '',
		values: {},

		...args,
	}

	ctEvents.trigger(`ct:${panelType}:sync:item:${getOriginalId(itemId)}`, {
		itemId: shortenItemId(itemId),

		optionId,
		optionValue,
		values,
		// TODO: implement
		getFullValuesForItem: () => ({}),
	})

	if (!variableDescriptors[getOriginalId(itemId)]) return

	const itemDescriptors = variableDescriptors[getOriginalId(itemId)]

	const descriptor = (isFunction(itemDescriptors)
		? itemDescriptors({ itemId: shortenItemId(itemId) })
		: itemDescriptors)[optionId]

	if (!descriptor) {
		return
	}

	;(Array.isArray(descriptor) ? descriptor : [descriptor]).map((d) =>
		handleSingleVariableFor(d, d.fullValue ? values : optionValue)
	)
}

const compare = function (obj1, obj2) {
	if (typeof obj1 !== typeof obj2) {
		return false
	}

	if (typeof obj1 !== 'object' && typeof obj2 !== 'object') {
		return obj1 === obj2
	}

	for (var p in obj1) {
		if (obj1.hasOwnProperty(p) !== obj2.hasOwnProperty(p)) return false

		switch (typeof obj1[p]) {
			case 'object':
				if (!compare(obj1[p], obj2[p])) return false
				break
			default:
				if (obj1[p] != obj2[p]) return false
		}
	}

	for (var p in obj2) {
		if (typeof obj1[p] == 'undefined') return false
	}

	return true
}

setTimeout(() => {
	ctEvents.trigger(
		'ct:header:sync:collect-variable-descriptors',
		headerVariableDescriptors
	)

	ctEvents.trigger(
		'ct:footer:sync:collect-variable-descriptors',
		footerVariableDescriptors
	)
})

const makeShortcutFor = (item) => {
	if ([...item.children].find((e) => e.matches('.ct-customizer-shortcut'))) {
		return
	}

	if (!item.dataset.location) {
		return
	}

	const shortcut = document.createElement('a')

	shortcut.classList.add('ct-customizer-shortcut')

	if (item.dataset.shortcut === 'drop') {
		shortcut.innerHTML = `
    <svg viewBox="0 0 24 24"><path d="M3,12c0,1.1,0.9,2,2,2s2-0.9,2-2s-0.9-2-2-2S3,10.9,3,12z M10,12c0,1.1,0.9,2,2,2s2-0.9,2-2s-0.9-2-2-2S10,10.9,10,12z
   M17,12c0,1.1,0.9,2,2,2s2-0.9,2-2s-0.9-2-2-2S17,10.9,17,12z"/></svg>
        `
	} else {
		let text = __('Edit', 'blocksy')

		if (
			(item.dataset.location || '').indexOf(
				'header:builder_panel_top-row'
			) > -1
		) {
			text = 'Top Row'
		}

		if (
			(item.dataset.location || '').indexOf(
				'header:builder_panel_middle-row'
			) > -1
		) {
			text = 'Main Row'
		}

		if (
			(item.dataset.location || '').indexOf(
				'header:builder_panel_bottom-row'
			) > -1
		) {
			text = 'Bottom Row'
		}

		shortcut.innerHTML = text
	}

	item.removeAttribute('data-item-label')

	shortcut.addEventListener('click', (e) => {
		e.preventDefault()
		wp.customize.preview.send(
			'ct-initiate-deep-link',
			item.dataset.location
		)
	})

	item.appendChild(shortcut)
}

ctEvents.on('ct:header:render-frame', () => {
	;[
		...document.querySelectorAll('#main-container > header [data-id]'),
		...document.querySelectorAll('#main-container > header [data-row]'),
		...document.querySelectorAll(
			'#main-container > footer [data-shortcut]'
		),
		...document.querySelectorAll('.hero-section'),
		...document.querySelectorAll('.entries[data-cards]'),
		...document.querySelectorAll('aside#sidebar'),
		...document.querySelectorAll('#main-container > footer [data-row]'),
		...document.querySelectorAll('#offcanvas .ct-bag-container'),
	].map((el) => makeShortcutFor(el))
})

wp.customize.bind('preview-ready', () => {
	let skipNextRefresh = false

	wp.customize.selectiveRefresh.bind(
		'render-partials-response',
		(response) => {
			if (!response.ct_dynamic_css) {
				return
			}

			const deviceMapping = {
				desktop: 'ct-main-styles-inline-css',
				tablet: 'ct-main-styles-tablet-inline-css',
				mobile: 'ct-main-styles-mobile-inline-css',
			}

			;['desktop', 'tablet', 'mobile'].map((device) => {
				const cssContainer = document.querySelector(
					`style#${deviceMapping[device]}`
				)

				cssContainer.innerText = response.ct_dynamic_css[device]
			})
		}
	)

	wp.customize.selectiveRefresh.bind(
		'partial-content-rendered',
		(placement) => {
			if (placement.container.is('header#header')) {
				document.body.dataset.header = placement.container.attr(
					'data-id'
				)
			}

			if (placement.container.is('footer.site-footer')) {
				document.body.dataset.footer = placement.container.attr(
					'data-id'
				)
			}
		}
	)

	wp.customize.selectiveRefresh.Partial.prototype.preparePlacement = function (
		placement
	) {
		if (this.params.loader_selector) {
			if (this.params.loader_selector.indexOf(':') > -1) {
				let [
					loader_selector,
					index,
				] = this.params.loader_selector.split(':')

				$(placement.container)
					.find(loader_selector)
					.toArray()
					.filter(
						(el) =>
							$(el.parentNode)
								.find(loader_selector)
								.toArray()
								.indexOf(el) +
								1 ===
							parseInt(index, 10)
					)
					.map((el) =>
						el.classList.add('customize-partial-refreshing')
					)
			} else {
				$(placement.container)
					.find(this.params.loader_selector)
					.addClass('customize-partial-refreshing')
			}

			return
		} else {
			$(placement.container).addClass('customize-partial-refreshing')
		}
	}

	wp.customize.selectiveRefresh.Partial.prototype.createEditShortcutForPlacement = () => {}
	wp.customize.selectiveRefresh.Partial.prototype.ready = function () {
		var partial = this

		_.each(partial.placements(), function (placement) {
			// $( placement.container ).attr( 'title', self.data.l10n.shiftClickToEdit );
			partial.createEditShortcutForPlacement(placement)
		})

		$(document).on('click', partial.params.selector, function (e) {
			if (!e.shiftKey) {
				return
			}
			e.preventDefault()
			_.each(partial.placements(), function (placement) {
				if ($(placement.container).is(e.currentTarget)) {
					partial.showControl()
				}
			})
		})
	}

	wp.customize.selectiveRefresh.Partial.prototype.isRelatedSetting = function (
		setting,
		newValue,
		oldValue
	) {
		var partial = this

		if (_.isString(setting)) {
			setting = wp.customize(setting)
		}

		if (!setting) {
			return false
		}

		if (
			_.indexOf(partial.settings(), setting.id) > -1 &&
			(partial.settings().indexOf('header_placements') > -1 ||
				partial.settings().indexOf('footer_placements') > -1)
		) {
			if (partial.id.indexOf(':') > -1) {
				const [_, itemId] = partial.id.split(':')

				const item = ct_customizer_localizations.header_builder_data[
					partial.settings().indexOf('header_placements') > -1
						? 'header'
						: 'footer'
				].find(({ id }) => id === itemId)

				if (!item) {
					return false
				}

				if (newValue.__should_refresh_item__) {
					const [
						expectedItemId,
						optionId,
					] = newValue.__should_refresh_item__.split(':')

					if (
						expectedItemId === itemId &&
						item.config.selective_refresh.indexOf(optionId) > -1
					) {
						return true
					}
				}

				return false
			}

			if (
				Object.keys(newValue).indexOf('__should_refresh__') > -1 &&
				newValue.__should_refresh__
			) {
				return true
			}

			return false
		}

		return -1 !== _.indexOf(partial.params.settings, setting.id)
	}

	wp.customize.preview.bind(
		'ct:header:receive-value-update',
		({ optionId, optionValue, values, futureItems, itemId }) => {
			if (
				(itemId === 'top-row' ||
					itemId === 'middle-row' ||
					itemId === 'bottom-row') &&
				optionId === 'headerRowHeight'
			) {
				const enabledRows = Array.from(
					document.querySelectorAll('header#header [data-row]')
				).map((el) => `${el.dataset.row}-row`)

				if (enabledRows.length > 0) {
					handleSingleVariableFor(
						{
							selector: ':root',
							variable: 'headerHeight',
							responsive: true,
							unit: 'px',
						},
						enabledRows.reduce(
							(currentDescriptor, currentRow) => {
								const defaults = {
									'top-row': {
										mobile: 50,
										tablet: 50,
										desktop: 50,
									},
									'middle-row': {
										mobile: 70,
										tablet: 70,
										desktop: 120,
									},
									'bottom-row': {
										mobile: 80,
										tablet: 80,
										desktop: 80,
									},
								}[currentRow]

								const properValue =
									(
										futureItems.find(
											({ id }) => currentRow === id
										) || {
											values: {},
										}
									).values['headerRowHeight'] || defaults

								return {
									mobile:
										parseFloat(currentDescriptor.mobile) +
										parseFloat(properValue.mobile),
									tablet:
										parseFloat(currentDescriptor.tablet) +
										parseFloat(properValue.tablet),
									desktop:
										parseFloat(currentDescriptor.desktop) +
										parseFloat(properValue.desktop),
								}
							},
							{
								mobile: 0,
								tablet: 0,
								desktop: 0,
							}
						)
					)
				}
			}

			handleItemChangeFor({
				panelType: 'header',
				variableDescriptors: headerVariableDescriptors,
				itemId,
				optionId,
				optionValue,
				values,
			})
		}
	)

	wp.customize.preview.bind('ct:footer:receive-value-update', (args) =>
		handleItemChangeFor({
			panelType: 'footer',
			variableDescriptors: footerVariableDescriptors,
			...args,
		})
	)

	wp.customize.preview.bind(
		'ct:sync:refresh_partial',
		({ id, shouldSkip = false }) => {
			if (shouldSkip) {
				skipNextRefresh = true
				setTimeout(() => (skipNextRefresh = false), 100)

				return
			}
			if (
				Object.keys(
					wp.customize.selectiveRefresh._pendingPartialRequests
				).length > 0
			) {
				return
			}

			let partial = wp.customize.selectiveRefresh.partial(id)

			if (partial && !skipNextRefresh) {
				if (partial.params.loader_selector === 'skip') {
					skipNextRefresh = true
					setTimeout(() => (skipNextRefresh = false), 1500)
					return
				}

				partial.refresh()
			}
		}
	)
})
