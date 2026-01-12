import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import { WrapperEditor } from './components/wrapper-editor';
import { WrapperOptions } from './components/wrapper-options';
import { WrapperToolbar } from './components/wrapper-toolbar';

export const Wrapper = (props) => {
	const {
		props: { setAttributes, attributes },
		children,
	} = props;

	return (
		<>
			<InspectorControls>
				<WrapperOptions
					attributes={attributes}
					setAttributes={setAttributes}
				/>
			</InspectorControls>

			<BlockControls>
				<WrapperToolbar
					attributes={attributes}
					setAttributes={setAttributes}
				/>
			</BlockControls>

			<WrapperEditor
				attributes={attributes}
				children={children}
				setAttributes={setAttributes}
			/>
		</>
	);
};
