import { __ } from '@wordpress/i18n';
import { checkAttr, getAttrKey, getHiddenOptions, getOption } from '@eightshift/frontend-libs-tailwind/scripts';
import { Container, ContainerGroup, HStack, OptionSelect } from '@eightshift/ui-components';
import manifest from './../manifest.json';

export const ParagraphOptions = (attributes) => {
	const { setAttributes, hideOptions } = attributes;

	const hiddenOptions = getHiddenOptions(hideOptions);

	const paragraphUse = checkAttr('paragraphUse', attributes, manifest);
	const paragraphSize = checkAttr('paragraphSize', attributes, manifest);

	const fontSizes = getOption('paragraphSize', attributes, manifest);

	if (!paragraphUse) {
		return null;
	}

	return (
		<ContainerGroup horizontal>
			<Container
				lessSpaceStart
				lessSpaceEnd
				hidden={hiddenOptions.size}
			>
				<HStack>
					<OptionSelect
						aria-label={__('Font size', 'eightshift-boilerplate')}
						options={fontSizes}
						onChange={(value) => setAttributes({ [getAttrKey('paragraphSize', attributes, manifest)]: value })}
						value={paragraphSize}
						type='menu'
						hidden={hiddenOptions.size}
					/>
				</HStack>
			</Container>
		</ContainerGroup>
	);
};
