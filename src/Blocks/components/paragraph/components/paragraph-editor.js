import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { checkAttr, getAttrKey, tailwindClasses } from '@eightshift/frontend-libs-tailwind/scripts';
import manifest from './../manifest.json';

export const ParagraphEditor = (attributes) => {
	const {
		setAttributes,
		placeholder = __('Add content', 'eightshift-boilerplate'),
		additionalClass,

		mergeBlocks,
		onReplace,
		onRemove,
	} = attributes;

	const paragraphUse = checkAttr('paragraphUse', attributes, manifest);
	const paragraphContent = checkAttr('paragraphContent', attributes, manifest);

	if (!paragraphUse) {
		return null;
	}

	return (
		<RichText
			identifier={getAttrKey('paragraphContent', attributes, manifest)}
			className={tailwindClasses('base', attributes, manifest, additionalClass)}
			placeholder={placeholder}
			value={paragraphContent}
			onChange={(value) => setAttributes({ [getAttrKey('paragraphContent', attributes, manifest)]: value })}
			allowedFormats={['core/bold', 'core/link', 'core/italic']}
			onMerge={mergeBlocks}
			onReplace={onReplace}
			onRemove={onRemove}
			deleteEnter
		/>
	);
};
