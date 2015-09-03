// JavaScript Document
jQuery(function($) {
        $('#imgcrop').Jcrop({
            bgColor:     'black',
            bgOpacity:   .4,
            aspectRatio: 10 / 4,
			maxSize: [1000,400],
			setSelect: [0,0,0,1000]
        });
    });