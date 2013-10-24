MyContact = function(config) {

    if (!jQuery) {
        console.log('jQuery not found');
        return;
    }

    var module = this;

    (function($){
        module.config = $.extend({
            jqueryFormPluginUrl: "js/jquery.form.js",
            formSelector: "#contact-form",
            beforeSend: null,
            complete: null
        }, config);

        module.init = function($form) {
            var $formContainer = $form.parent();

            var ajaxOptions = {
                beforeSend: module.config.beforeSend,
                success: function(response, textStatus, jqXHR) {
                    if (status == "error") {
                        $formContainer.html(jqXHR.responseText);
                        return;
                    }
                    $formContainer.html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $formContainer.html(jqXHR.responseText);
                },
                complete: module.config.complete
            };

            $form.ajaxForm( $.extend(ajaxOptions, { delegation: true }) );

            $formContainer.on('click', 'a.reload', function(event){
                var $link = $(this);
                $.ajax($.extend(ajaxOptions, { url: $link.attr('href') }));

                event.preventDefault();
            });
        };

        $(function(){
            var $form = $(module.config.formSelector);

            if (! $form.length) {
                return;
            }

            if (! $.fn.ajaxForm) {
                yepnope([{
                    load: module.config.jqueryFormPluginUrl,
                    complete: function(){ module.init($form); }
                }]);
            } else {
                module.init($form);
            }
        });

    })(jQuery);

}
