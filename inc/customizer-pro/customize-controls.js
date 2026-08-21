( function( api ) {

	// Extends our custom "free-blog" section.
	api.sectionConstructor['free-blog'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
