import { props } from '@eightshift/frontend-libs-tailwind/scripts';
import { ParagraphOptions as OptionsComponent } from '../../../components/paragraph/components/paragraph-options';
import { ContainerPanel } from '@eightshift/ui-components';

export const ParagraphOptions = ({ attributes, setAttributes }) => {
	return (
		<ContainerPanel>
			<OptionsComponent
				{...props('paragraph', attributes, {
					setAttributes,
				})}
				controlOnly
			/>
		</ContainerPanel>
	);
};
