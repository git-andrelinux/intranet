<?php

if (! isset($location)) {
	$location = 'Header Menu 1';
}

$options = [
	'menu_source' => [
		'label' => __('Menu Source', 'blocksy'),
		'type' => 'ct-radio',
		'value' => 'menu',
		'view' => 'text',
		'design' => 'block',
		'divider' => 'bottom',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => [
			'menu' => __( 'Select Menu', 'blocksy' ),
			'location' => __( 'Use Location', 'blocksy' ),
		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [ 'menu_source' => 'menu' ],
		'options' => [
			'menu' => [
				'label' => __('Select Menu', 'blocksy'),
				'type' => 'ct-select',
				'value' => blocksy_get_default_menu('main'),
				'view' => 'text',
				'design' => 'inline',
				'setting' => [ 'transport' => 'postMessage' ],
				'placeholder' => __('Select menu...', 'blocksy'),
				'choices' => blocksy_ordered_keys(blocksy_get_menus_items()),
				'desc' => sprintf(
					// translators: placeholder here means the actual URL.
					__( 'Manage your menu items in the %sMenus screen%s.', 'blocksy' ),
					sprintf(
						'<a href="%s" target="_blank">',
						admin_url('/nav-menus.php')
					),
					'</a>'
				),
			]
		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [ 'menu_source' => 'location' ],
		'options' => [

			blocksy_rand_md5() => [
				'type' => 'ct-title',
				'variation' => 'menu-location',
				'label' => sprintf(
					// translators: placeholders is menu location
					__( 'Location Name: %s', 'blocksy' ),
					$location
				),
				'desc' => sprintf(
					// translators: placeholder here means the actual URL.
					__( 'Go to %sMenus screen%s and assign a menu to this location.', 'blocksy' ),
					sprintf(
						'<a href="%s" target="_blank">',
						admin_url('/nav-menus.php')
					),
					'</a>'
				),
			],

		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-title',
		'label' => __( 'Top Level Options', 'blocksy' ),
	],

	blocksy_rand_md5() => [
		'title' => __( 'General', 'blocksy' ),
		'type' => 'tab',
		'options' => [

			'header_menu_type' => [
				'label' => false,
				'type' => 'ct-image-picker',
				'value' => 'type-1',
				'attr' => [ 'data-type' => 'background' ],
				'setting' => [ 'transport' => 'postMessage' ],
				'switchDeviceOnChange' => 'desktop',
				'choices' => [

					'type-1' => [
						'src'   => blocksy_image_picker_url( 'menu-type-1.svg' ),
						'title' => __( 'Type 1', 'blocksy' ),
					],

					'type-2' => [
						'src'   => blocksy_image_picker_url( 'menu-type-2.svg' ),
						'title' => __( 'Type 2', 'blocksy' ),
					],

					'type-3' => [
						'src'   => blocksy_image_picker_url( 'menu-type-3.svg' ),
						'title' => __( 'Type 3', 'blocksy' ),
					],

					'type-4' => [
						'src'   => blocksy_image_picker_url( 'menu-type-4.svg' ),
						'title' => __( 'Type 4', 'blocksy' ),
					],
				],
			],

			'headerMenuItemsSpacing' => [
				'label' => __( 'Items Spacing', 'blocksy' ),
				'type' => 'ct-slider',
				'value' => 25,
				'min' => 5,
				'max' => 100,
				'setting' => [ 'transport' => 'postMessage' ],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [ 'header_menu_type' => '!type-1' ],
				'options' => [

					'headerMenuItemsHeight' => [
						'label' => __( 'Items Height', 'blocksy' ),
						'type' => 'ct-slider',
						'value' => 100,
						'min' => 30,
						'max' => 100,
						'defaultUnit' => '%',
						'setting' => [ 'transport' => 'postMessage' ],
					],

				],
			],

			'stretch_menu' => [
				'label' => __( 'Stretch Menu', 'blocksy' ),
				'type' => 'ct-switch',
				'value' => 'no',
				'desc' => __('Enabling this option will make the menu to stretch and fit the width of its parent column. ', 'blocksy'),
				'setting' => [ 'transport' => 'postMessage' ],
			],

		],
	],

	blocksy_rand_md5() => [
		'title' => __( 'Design', 'blocksy' ),
		'type' => 'tab',
		'options' => [

			'headerMenuFont' => [
				'type' => 'ct-typography',
				'label' => __( 'Font', 'blocksy' ),
				'value' => blocksy_typography_default_values([
					'size' => '12px',
					'variation' => 'n7',
					'line-height' => '1.3',
					'text-transform' => 'uppercase',
				]),
				'typography_responsive' => [
					'desktop' => true,
					'tablet' => false,
					'mobile' => false,
				],
				'setting' => [ 'transport' => 'postMessage' ],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-labeled-group',
				'label' => __( 'Font Color', 'blocksy' ),
				'responsive' => false,
				'choices' => [
					[
						'id' => 'menuFontColor',
						'label' => __('Default State', 'blocksy')
					],

					[
						'id' => 'transparentMenuFontColor',
						'label' => __('Transparent State', 'blocksy'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyMenuFontColor',
						'label' => __('Sticky State', 'blocksy'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'menuFontColor' => [
						'label' => __( 'Font Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => 'var(--color)',
							],

							'hover' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover-type-3' => [
								'color' => '#ffffff',
							],
						],

						'pickers' => [
							[
								'title' => __( 'Initial', 'blocksy' ),
								'id' => 'default',
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover',
								'inherit' => 'var(--linkHoverColor)',
								'condition' => [ 'header_menu_type' => '!type-3' ]
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover-type-3',
								'condition' => [ 'header_menu_type' => 'type-3' ]
							],
						],
					],

					'transparentMenuFontColor' => [
						'label' => __( 'Font Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover-type-3' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __( 'Initial', 'blocksy' ),
								'id' => 'default',
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover',
								'condition' => [ 'header_menu_type' => '!type-3' ]
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover-type-3',
								'condition' => [ 'header_menu_type' => 'type-3' ]
							],
						],
					],

					'stickyMenuFontColor' => [
						'label' => __( 'Font Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover-type-3' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __( 'Initial', 'blocksy' ),
								'id' => 'default',
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover',
								'condition' => [ 'header_menu_type' => '!type-3' ]
							],

							[
								'title' => __( 'Hover/Active', 'blocksy' ),
								'id' => 'hover-type-3',
								'condition' => [ 'header_menu_type' => 'type-3' ]
							],
						],
					],

				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-labeled-group',
				'label' => __( 'Active Indicator Color', 'blocksy' ),
				'responsive' => false,
				'divider' => 'top',
				'choices' => [
					[
						'id' => 'menuIndicatorColor',
						'label' => __('Default State', 'blocksy'),
						'condition' => [ 'header_menu_type' => '!type-1' ],
					],

					[
						'id' => 'transparentMenuIndicatorColor',
						'label' => __('Transparent State', 'blocksy'),
						'condition' => [
							'header_menu_type' => '!type-1',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyMenuIndicatorColor',
						'label' => __('Sticky State', 'blocksy'),
						'condition' => [
							'header_menu_type' => '!type-1',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'menuIndicatorColor' => [
						'label' => __( 'Active Indicator Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'active' => [
								'color' => 'var(--paletteColor1)',
							],
						],

						'pickers' => [
							[
								'title' => __( 'Active', 'blocksy' ),
								'id' => 'active',
							],
						],
					],

					'transparentMenuIndicatorColor' => [
						'label' => __( 'Active Indicator Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'active' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __( 'Active', 'blocksy' ),
								'id' => 'active',
							],
						],
					],

					'stickyMenuIndicatorColor' => [
						'label' => __( 'Active Indicator Color', 'blocksy' ),
						'type'  => 'ct-color-picker',
						'design' => 'inline',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'active' => [
								'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __( 'Active', 'blocksy' ),
								'id' => 'active',
							],
						],
					],

				],
			],

			'headerMenuMargin' => [
				'label' => __( 'Margin', 'blocksy' ),
				'type' => 'ct-spacing',
				'divider' => 'top',
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => blocksy_spacing_value([
					'top' => 'auto',
					'bottom' => 'auto',
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-title',
		'label' => __( 'Dropdown Options', 'blocksy' ),
	],

	blocksy_rand_md5() => [
		'title' => __( 'General', 'blocksy' ),
		'type' => 'tab',
		'options' => [

			'dropdown_items_type' => [
				'label' => __('Items Hover Effect', 'blocksy'),
				'type' => 'ct-radio',
				'value' => 'simple',
				'view' => 'radio',
				'design' => 'block',
				'divider' => 'bottom',
				'attr' => [ 'data-columns' => '2' ],
				'setting' => [ 'transport' => 'postMessage' ],
				'choices' => [
					'simple' => __( 'Simple', 'blocksy' ),
					'solid' => __( 'Solid Color', 'blocksy' ),
					'padded' => __( 'Boxed Color', 'blocksy' ),
					// 'bordered' => __( 'Bordered', 'blocksy' ),
				],
			],

			'dropdownItemsSpacing' => [
				'label' => __( 'Items Spacing', 'blocksy' ),
				'type' => 'ct-slider',
				'value' => 13,
				'min' => 5,
				'max' => 30,
				'setting' => [ 'transport' => 'postMessage' ],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-divider',
			],

			'dropdown_animation' => [
				'label' => __('Dropdown Reveal Effect', 'blocksy'),
				'type' => 'ct-radio',
				'value' => 'type-1',
				'view' => 'radio',
				'design' => 'block',
				'divider' => 'bottom',
				'attr' => [ 'data-columns' => '2' ],
				'setting' => [ 'transport' => 'postMessage' ],
				'choices' => [
					'type-1' => __( 'Default', 'blocksy' ),
					'type-3' => __( 'Inner Reveal', 'blocksy' ),
					'type-2' => __( 'Opacity', 'blocksy' ),
					'type-4' => __( 'Simple', 'blocksy' ),
				],
			],

			'dropdownTopOffset' => [
				'label' => __( 'Dropdown Top Offset', 'blocksy' ),
				'type' => 'ct-slider',
				'value' => 0,
				'min' => -50,
				'max' => 50,
				'steps' => 'half',
				'setting' => [ 'transport' => 'postMessage' ],
			],

			'dropdownMenuWidth' => [
				'label' => __( 'Dropdown Width', 'blocksy' ),
				'type' => 'ct-slider',
				'value' => 200,
				'min' => 100,
				'max' => 300,
				'divider' => 'bottom',
				'setting' => [ 'transport' => 'postMessage' ],
			],

		],
	],

	blocksy_rand_md5() => [
		'title' => __( 'Design', 'blocksy' ),
		'type' => 'tab',
		'options' => [

			'headerDropdownFont' => [
				'type' => 'ct-typography',
				'label' => __( 'Font', 'blocksy' ),
				'value' => blocksy_typography_default_values([
					'size' => '12px',
					'variation' => 'n5',
				]),
				'typography_responsive' => [
					'desktop' => true,
					'tablet' => false,
					'mobile' => false,
				],
				'setting' => [ 'transport' => 'postMessage' ],
			],

			'headerDropdownFontColor' => [
				'label' => __( 'Font Color', 'blocksy' ),
				'type'  => 'ct-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'setting' => [ 'transport' => 'postMessage' ],

				'value' => [
					'default' => [
						'color' => '#ffffff',
					],

					'hover' => [
						'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __( 'Initial', 'blocksy' ),
						'id' => 'default',
					],

					[
						'title' => __( 'Hover/Active', 'blocksy' ),
						'id' => 'hover',
						'inherit' => 'var(--linkHoverColor)'
					],
				],
			],

			'headerDropdownBackground' => [
				'label' => __( 'Items Background Color', 'blocksy' ),
				'type'  => 'ct-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'setting' => [ 'transport' => 'postMessage' ],

				'value' => [
					'default' => [
						'color' => '#29333C',
					],

					'hover' => [
						'color' => '#34414c',
					],
				],

				'pickers' => [
					[
						'title' => __( 'Initial', 'blocksy' ),
						'id' => 'default',
					],

					[
						'title' => __( 'Hover/Active', 'blocksy' ),
						'id' => 'hover',
						'condition' => [ 'dropdown_items_type' => 'solid|padded' ]
					],
				],
			],

			'headerDropdownDivider' => [
				'label' => __( 'Items Divider', 'blocksy' ),
				'type' => 'ct-border',
				'design' => 'inline',
				'divider' => 'bottom',
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => [
					'width' => 1,
					'style' => 'dashed',
					'color' => [
						'color' => 'rgba(255, 255, 255, 0.1)',
					],
				]
			],

			'headerDropdownShadow' => [
				'label' => __( 'Dropdown Shadow', 'blocksy' ),
				'type' => 'ct-box-shadow',
				'design' => 'inline',
				'divider' => 'bottom',
				'value' => blocksy_box_shadow_value([
					'enable' => true,
					'h_offset' => 0,
					'v_offset' => 10,
					'blur' => 20,
					'spread' => 0,
					'inset' => false,
					'color' => [
						'color' => 'rgba(41, 51, 61, 0.1)',
					],
				])
			],

			'headerDropdownRadius' => [
				'label' => __( 'Dropdown Border Radius', 'blocksy' ),
				'type' => 'ct-spacing',
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => blocksy_spacing_value([
					'linked' => false,
					'top' => '0px',
					'left' => '2px',
					'right' => '0px',
					'bottom' => '2px',
				]),
				// 'responsive' => true
			],

		],
	],
];
