import { useMemo, useRef, useState, useEffect } from '@wordpress/element'
import classnames from 'classnames'
import { __ } from 'ct-i18n'

export function nullifyTransforms(el) {
	const parseTransform = (el) =>
		window
			.getComputedStyle(el)
			.transform.split(/\(|,|\)/)
			.slice(1, -1)
			.map((v) => parseFloat(v))

	// 1
	let { top, left, width, height } = el.getBoundingClientRect()
	let transformArr = parseTransform(el)

	if (transformArr.length == 6) {
		// 2D matrix
		const t = transformArr

		// 2
		let det = t[0] * t[3] - t[1] * t[2]

		// 3
		return {
			width: width / t[0],
			height: height / t[3],
			left: (left * t[3] - top * t[2] + t[2] * t[5] - t[4] * t[3]) / det,
			top: (-left * t[1] + top * t[0] + t[4] * t[1] - t[0] * t[5]) / det,
		}
	} else {
		// This case is not handled because it's very rarely needed anyway.
		// We just return the tranformed metrics, as they are, for consistency.
		return { top, left, width, height }
	}
}

const usePopoverMaker = ({
	contentRef: contentRefProp,
	shouldCalculate = true,
	ref,
	defaultHeight = 0,
} = {}) => {
	const contentRef = useRef()
	const [s, setState] = useState(null)

	const refresh = () => {
		if (!shouldCalculate) {
			return
		}

		setState(Math.random())
	}

	useEffect(() => {
		setTimeout(() => {
			refresh()
		})

		window.addEventListener('resize', refresh)
		window.addEventListener('scroll', refresh, true)

		let observer

		if (ref.current) {
			observer = new window.ResizeObserver(refresh)

			observer.observe(ref.current, {
				attributes: true,
			})

			if (ref.current.closest('.ct-tabs-scroll')) {
				observer.observe(ref.current.closest('.ct-tabs-scroll'), {
					attributes: true,
				})
			}

			if (ref.current.closest('.customize-pane-child')) {
				observer.observe(ref.current.closest('.customize-pane-child'), {
					attributes: true,
				})
			}
		}

		if (contentRefProp ? contentRefProp.current : contentRef.current) {
			if (!observer) {
				observer = new window.ResizeObserver(refresh)
			}

			observer.observe(
				contentRefProp ? contentRefProp.current : contentRef.current,
				{
					attributes: true,
				}
			)
		}

		return () => {
			window.removeEventListener('resize', refresh)
			window.removeEventListener('scroll', refresh, true)

			if (observer) {
				observer.disconnect()
			}
		}
	}, [shouldCalculate, contentRef.current, contentRefProp, ref.current])

	let { right, yOffset, position } = useMemo(() => {
		let right = 0
		let yOffset = 0
		let position = 'bottom'

		if (!shouldCalculate) {
			return { yOffset, right, position }
		}

		if (ref.current) {
			let rect = ref.current.getBoundingClientRect()

			yOffset = rect.top + rect.height + 15
			right = window.innerWidth - rect.right

			if (document.body.classList.contains('rtl')) {
				right = rect.right.left
			}

			let popoverRect =
				(contentRefProp && contentRefProp.current) || contentRef.current
					? nullifyTransforms(
							contentRefProp
								? contentRefProp.current
								: contentRef.current
					  )
					: { height: defaultHeight }

			if (yOffset + popoverRect.height > window.innerHeight) {
				position = 'top'
				yOffset = window.innerHeight - rect.bottom + rect.height + 15
			}
		}

		return { yOffset, right, position }
	}, [
		s,
		shouldCalculate,
		ref.current,
		contentRefProp,
		contentRef.current,
		defaultHeight,
	])

	return {
		styles: {
			'--modal-y-offset': `${yOffset}px`,
			'--modal-x-offset': `${right}px`,
			// [position === 'bottom' ? 'top' : 'bottom']: `${yOffset}px`,
			// right: `${right}px`,
		},

		position,

		popoverProps: {
			ref: contentRefProp || contentRef,
			...(position
				? {
						'data-position': position,
				  }
				: {}),
		},
	}
}

export default usePopoverMaker
