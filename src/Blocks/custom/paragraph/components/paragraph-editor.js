import { tailwindClasses, props } from '@eightshift/frontend-libs-tailwind/scripts';
import { ParagraphEditor as EditorComponent } from '../../../components/paragraph/components/paragraph-editor';
import { overrideBlockAttrsByParent } from '../../../assets/scripts/block-attr-overrides';
import manifest from './../manifest.json';

export const ParagraphEditor = ({ attributes, setAttributes, onReplace, mergeBlocks, clientId }) => {
	overrideBlockAttrsByParent(clientId, attributes, setAttributes);

	return (
		<EditorComponent
			{...props('paragraph', attributes)}
			setAttributes={setAttributes}
			mergeBlocks={mergeBlocks}
			onReplace={onReplace}
			onRemove={onReplace ? () => onReplace([]) : undefined}
			additionalClass={tailwindClasses('base', attributes, manifest)}
		/>
	);
};
