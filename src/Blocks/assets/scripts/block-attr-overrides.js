import { select } from '@wordpress/data';

export const overrideBlockAttrsByParent = (clientId, attributes, setAttributes, options = { disableWrapper: true }) => {
	const { onHasParent, onHasNoParent, hasParentAttrs = {}, hasNoParentAttrs = {}, disableWrapper = true } = options;
	const blockParents = select('core/block-editor').getBlockParents(clientId);

	if (blockParents?.length) {
		if (onHasParent) {
			onHasParent();
		}

		let attrsToSet = { ...hasParentAttrs };

		if (disableWrapper && attributes?.wrapperUse) {
			attrsToSet.wrapperUse = false;
			attrsToSet.wrapperNoControls = true;
		}

		if (Object.keys(attrsToSet).length) {
			setAttributes({
				...attrsToSet,
			});
		}
	} else {
		if (onHasNoParent) {
			onHasNoParent();
		}

		let attrsToSet = { ...hasNoParentAttrs };

		if (disableWrapper && !attributes?.wrapperUse) {
			attrsToSet.wrapperUse = true;
			attrsToSet.wrapperNoControls = false;
		}

		if (Object.keys(attrsToSet).length) {
			setAttributes({
				...attrsToSet,
			});
		}
	}
};
