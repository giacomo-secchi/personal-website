( function ( blocks, element ) {
    var el = element.createElement;

    blocks.registerBlockType( 'personal-website/portfolio-gallery', {
        edit: function () {
            return el(
                'div',
                { className: 'portfolio-gallery-block' },
                'Portfolio Gallery: Le immagini appariranno nel Frontend.'
            );
        },
        save: function () {
            return null;
        },
    } );
} )( window.wp.blocks, window.wp.element );