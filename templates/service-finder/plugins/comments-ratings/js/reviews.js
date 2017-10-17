(function($){
	jQuery(document ).ready(function(){
		var $rates = jQuery('#add_comment_rating_wrap'),
			path = $rates.data('assets_path' ),
			default_rating = 4;

		if ( typeof jQuery('#add_post_rating').attr('data-pixrating') !== 'undefined' ) {
			default_rating = jQuery('#add_post_rating').attr('data-pixrating');
		}

		$rates.raty({
			half: false,
			target : '#add_post_rating',
			hints: pixreviews.hints,
			path: path,
			targetKeep : true,
			//targetType : 'score',
			targetType : 'hint',
			//precision  : true,
			score: default_rating,
			scoreName: 'pixrating',
			click: function(rating, evt) {
				jQuery('#add_post_rating' ).val( '' + rating );
				jQuery('#add_post_rating option[value="' + rating + '"]' ).attr( 'selected', 'selected' );
			},
			starType : 'i'
		});

		jQuery('.review_rate' ).raty({
			readOnly: true,
			target : this,
			half: false,
			starType : 'i',
			score: function() {
				return jQuery(this).attr('data-pixrating');
			},
			scoreName: 'pixrating'
		});
	});
})(jQuery);