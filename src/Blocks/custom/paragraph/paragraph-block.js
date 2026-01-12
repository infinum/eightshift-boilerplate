import { GutenbergBlock } from '@eightshift/frontend-libs-tailwind/scripts';
import { ParagraphEditor } from './components/paragraph-editor';
import { ParagraphOptions } from './components/paragraph-options';

export const Paragraph = (props) => (
	<GutenbergBlock
		{...props}
		options={ParagraphOptions}
		editor={ParagraphEditor}
		noOptionsContainer
	/>
);
