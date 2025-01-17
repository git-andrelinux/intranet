import {
	createElement,
	Component,
	useEffect,
	useState,
	useContext,
	createContext,
	Fragment
} from '@wordpress/element'
import { Dialog, DialogOverlay, DialogContent } from './reach/dialog'
import { Transition } from 'react-spring'
import { __ } from 'ct-i18n'
import classnames from 'classnames'

// import '@reach/dialog/styles.css'

const defaultIsVisible = i => !!i

const Overlay = ({
	items,
	isVisible = defaultIsVisible,
	render,
	className,
	initialFocusRef,
	onDismiss
}) => {
	return (
		<Transition
			items={items}
			onStart={() =>
				document.body.classList[isVisible(items) ? 'add' : 'remove'](
					'ct-dashboard-overlay-open'
				)
			}
			config={{ duration: 200 }}
			from={{ opacity: 0, y: -10 }}
			enter={{ opacity: 1, y: 0 }}
			leave={{ opacity: 0, y: 10 }}>
			{items =>
				isVisible(items) &&
				(props => (
					<DialogOverlay
						style={{ opacity: props.opacity }}
						container={document.body}
						onDismiss={() => onDismiss()}
						initialFocusRef={initialFocusRef}>
						<DialogContent
							className={className}
							style={{
								transform: `translate3d(0px, ${props.y}px, 0px)`
							}}>
							<button
								className="close-button"
								onClick={() => onDismiss()}>
								×
							</button>

							{render(items, props)}
						</DialogContent>
					</DialogOverlay>
				))
			}
		</Transition>
	)
}

export default Overlay
