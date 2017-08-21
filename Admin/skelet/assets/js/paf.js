jQuery(document).ready(function ($) {

    // Media upload fields
    $('.paf-option-type-media').each(function () {

        var $input = $(this);
        var $button = $input.siblings('a');

        $()
        // .add( $input )
            .add($button)
            .click(function () {

                wp.media.editor.send.attachment = function (props, attachment) {
                    $input.val(attachment.url).change();
                }
                wp.media.editor.open($);
                return false;
            })
        ;
    });

    // Add thumbnails to media upload fields
    $('.paf-option-type-media').change(function () {

        var $input = $(this);
        var $button = $input.siblings('a.button');
        var $parent = $input.parent();
        var value = $input.val();
        var preview_url;
        var $element;

        // Add a thumbnail placeholder if missing
        $element = $parent.find('> .paf-option-type-media-preview');
        if (!$element.length) {
            $parent.prepend('<div class="paf-option-type-media-preview"></div>');
            $element = $parent.find('> .paf-option-type-media-preview');
        }

        // Empty then fill the placeholder
        $element.html(null);
        if (value) {
            if (-1 !== $.inArray(extension(value), ['gif', 'jpeg', 'jpg', 'png'])) {
                // File is an image
                preview_url = value;
            } else {
                // File is not an image
                preview_url = path2png(value); //;paf_assets + 'img/' + extension( value ) + '.png';
            }

            var $img = $('<img />')
                .attr('src', preview_url)
                .attr('alt', value)
                .attr('title', value)
            ;
            var $a = $('<a />')
                .attr('class', 'paf-media-delete-button')
                .attr('href', '#')
                .append('<div class="media-modal-icon">Remove</div>')
            ;
            $element.append($img);
            $element.append($a);
            $()
                .add($input)
                .add($button)
                .hide()
            ;
        } else {
            $()
                .add($input)
                .add($button)
                .slideDown('fast')
            ;
        }
    }).change();

    // Handle media removal buttons
    $(document).on('click', '.paf-media-delete-button', function (e) {

        e.preventDefault();

        var $delete_button = $(this);
        var $input = $delete_button.parent().siblings('input');

        $input.val('').change();
    });

    // Select2
    if ($('.paf-option-type-select').length) {
        $('.paf-option-type-select').select2();
    }

    // turn select.paf-(radio|checkbox) into radio|checkbox
    $('.paf-option-type-checkbox,.paf-option-type-radio').each(function (i, select) {

        var $this = $(this);
        var $select = $(select);
        var type = $this.hasClass('paf-option-type-checkbox') ? 'checkbox' : 'radio';
        var separator = $this.data('paf-separator');
        var conditions = $this.data('paf-conditions');
        var _default = $this.data('paf-default');
        var $fieldset = $('<fieldset>');

        $select.find('option').each(function (j, option) {

            var $option = $(option);
            var option_is_url = isURL($option.text());

            // Turn URLs into image tags
            if (option_is_url) {
                $option.text('<img src="' + $option.text() + '" />');
            }

            // Skip the empty radio
            if ('radio' === type && '__none__' === $option.val()) {
                return;
            }

            // Create a choice
            var $choice = $('<input />')
                .attr('type', type)
                .attr('name', $select.attr('name'))
                .attr('value', $option.val())
            ;

            if (conditions) {
                $choice.attr('data-paf-conditions', conditions);
            }

            if (_default) {
                $choice.attr('data-paf-default', _default);
            }

            // Set checked if the option was selected
            if ($option.attr('selected')) {
                $choice.attr('checked', 'checked');
            }

            // Wrap inside label
            $choice = $('<label />').html($choice[0].outerHTML + $option.text());

            // Mark if image
            if (option_is_url) {
                $choice.addClass('paf-label-with-image');
            }

            // Insert
            $fieldset.append($choice);

            // Insert separator after all but last option
            if (j < $select.find('option').length - 1) {
                $fieldset.append(separator);
            }
        });

        // Remove dropdown
        $select.before($fieldset);
        $select.remove();
    });

    // Handle conditions
    /**
     * Build a new object
     * { { master, slave, operator, values }, ... }
     */
    var dependencies = [];
    $('[data-paf-conditions]').each(function () {

        var $slave = $(this);
        var slave_name = $slave.attr('name');
        var conditions = JSON.parse(unescape($slave.data('paf-conditions')));

        for (var i in conditions) {

            var master = conditions[i][0];
            var operator = conditions[i][1];
            var values = conditions[i][2];

            dependencies.push({
                "master": master
                , "slave": slave_name
                , "operator": operator
                , "values": values
            });
        }
        return;
    });
    // Attach dependency checker on when applicable
    $('[name^="paf["]').each(function () {

        var $master = $(this);
        master = $master.attr('name');
        // Maybe it's a checkbox in which case the name will have [] at the end, we have to remove it
        if (master.lastIndexOf('[]') > -1) {
            master = master.slice(0, master.length - 2);
        }

        for (i in dependencies) {
            var dependency_master = 'paf[' + dependencies[i].master + ']';
            if (dependency_master === master) {
                $master
                    .bind('change keyup', function () {

                        var slaves = get_slaves(master);
                        for (i in slaves) {
                            handle_slave(slaves [i]);
                        }
                    })
                    .change()
                ;
            }
        }
    });

    // Handle reset button
    $('#paf-reset').click(function (e) {

        e.preventDefault();

        // Reset text
        $('input[type="email"],input[type="password"],input[type="text"]', '#paf-form').val('').change();

        // Reset checkbox
        $('#paf-form input[type="checkbox"]').attr('checked', false).change();

        // Reset radio
        $('#paf-form input[type="radio"]').attr('checked', false).change();

        // Reset select
        $('#paf-form option').attr('selected', false);
        $('#paf-form select').change();

        // Reset textarea and wp-editor
        $('#paf-form .wp-editor-wrap iframe').contents().find('body').html('');
        $('#paf-form textarea').val('').change();

        // Restore defaults for text
        $('#paf-form input[type="text"][data-paf-default]')
            .val(function () {
                return $(this).data('paf-default');
            })
            .change()
        ;

        // Fix color pickers colors
        $('#paf-form .wp-picker-container').each(function () {

            var $this = $(this);
            var backgroundColor = $(this).find('.wp-color-picker').val();

            $this
                .find('.wp-color-result')
                .css('background-color', backgroundColor)
            ;
        });

        // Restore defaults for textarea
        $('#paf-form textarea[data-paf-default]')
            .val(function () {
                return $(this).data('paf-default');
            })
            .change()
        ;

        // Restore defaults for wp-editor/text
        $('#paf-form textarea')
            .each(function () {

                var $this = $(this);
                var $parent_with_default = $this.parents('[data-paf-default]');
                var _default;

                if ($parent_with_default.length) {
                    _default = $parent_with_default.data('paf-default');
                    $this
                        .val(_default)
                        .change()
                    ;
                }
            })
        ;

        // Restore defaults for wp-editor/visual
        $('#paf-form .wp-editor-wrap')
            .each(function () {

                    var $this = $(this);
                    var $parent_with_default = $this.parents('[data-paf-default]');
                    var _default;

                    if ($parent_with_default.length) {
                        _default = $parent_with_default.data('paf-default');
                        $this.val(_default);
                        $('iframe', $this).contents().find('body').html(_default);
                    }
                }
            );

        // Restore defaults for select
        $('#paf-form select[data-paf-default]')
            .filter(function () {

                var $this = $(this);
                var _default = JSON.parse(unescape($(this).data('paf-default')));

                // select defaults
                for (i in _default) {
                    $this
                        .find('option[value="' + _default[i] + '"]')
                        .attr('selected', 'selected')
                    ;
                }

                return true;
            })
            .change()
        ;

        // Restore defaults for radio
        $('#paf-form input[type=radio][data-paf-default]')
            .attr('checked', function () {

                var $this = $(this);
                var _default = JSON.parse(unescape($this.data('paf-default')));

                for (i in _default) {
                    if (_default[i] == $this.val()) {
                        return true;
                    }
                }
            })
            .change()
        ;

        // Restore defaults for checkbox and radio
        $()
            .add($('#paf-form input[type=radio][data-paf-default]'))
            .add($('#paf-form input[type=checkbox][data-paf-default]'))
            .attr('checked', function () {

                var $this = $(this);
                var _default = JSON.parse(unescape($this.data('paf-default')));

                for (i in _default) {
                    if (_default[i] == $this.val()) {
                        return true;
                    }
                }
            })
            .change()
        ;
    });

    // Show/hide form on load/unload
    $('#paf-form').show();
    $(window).on('beforeunload', function () {

        $('#paf-form').animate({opacity: '0'}, 100);
    });

    function get_slaves(master) {

        var slaves = [];

        for (i in dependencies) {
            if (slaves.indexOf(dependencies[i].slave) == -1) {
                slaves.push(dependencies[i].slave);
            }
        }
        ;

        return slaves;
    }

    function handle_slave(slave) {

        var $slave = $('[name="' + slave + '"]');
        var $slave_tbl = $slave.parents('table');

        for (i in dependencies) {
            if (slave != dependencies[i].slave) {
                // Not interested in other slaves
                continue;
            } else {
                var master = dependencies[i].master;
                var $master;
                var master_type;
                var master_values;
                var master_values_req = dependencies[i].values;
                var operator = dependencies[i].operator;

                $master = $('[name="paf[' + master + ']"]');
                if (!$master.length) {
                    $master = $('[name="paf[' + master + '][]"]');
                }

                // Get master_type
                if ($master.is('select')) {
                    master_type = 'select';
                } else if ($master.is('textarea')) {
                    master_type = 'textarea';
                } else {
                    master_type = $master.first().attr('type');
                }

                // Get master values
                switch (master_type) {
                    case 'select':
                        master_values = $master
                            .find('option:selected')
                            .map(function () {
                                return this.value;
                            })
                            .get()
                        ;
                        break;
                    case 'radio':
                    case 'checkbox':
                        master_values = $master
                            .filter(':checked')
                            .map(function () {
                                return this.value;
                            })
                            .get()
                        ;
                        break;
                    default:
                        master_values = $master.val();
                }

                if (check_condition(master_values, master_values_req, operator)) {
                    continue;
                } else {
                    // Hide and exit funtion
                    return $slave_tbl.stop().slideUp('fast').css('opacity', '0');
                }
            }
        }
        // Show and exit function
        return $slave_tbl.stop().slideDown('fast').fadeTo('fast', '1');
    }

    /**
     * Checks if 'inputs [oprator] values' is true
     */
    function check_condition(inputs, values, operator) {

        // turn inputs and values into an array suitable for the function and sort the values in that array
        if (!( inputs instanceof Array )) {
            inputs = explode(',', inputs).sort();
        }
        if (!( values instanceof Array )) {
            values = explode(',', values).sort();
        }

        switch (operator) {
            case 'eq':
            case '=':
                return inputs.toString() == values.toString();
            case 'neq':
            case '!':
                return inputs.toString() != values.toString();
            case 'gt':
            case '>':
                return isNumber(inputs[0]) && inputs[0] > values[0];
            case 'lt':
            case '<':
                return isNumber(inputs[0]) && inputs[0] < values[0];
            case 'gte':
            case '>=':
                return isNumber(inputs[0]) && inputs[0] >= values[0];
            case 'lte':
            case '<=':
                return isNumber(inputs[0]) && inputs[0] <= values[0];
            case 'in':
                for (i in inputs) {
                    if (values.indexOf(inputs[i]) != -1) {
                        return true;
                    }
                }
                return false;
        }
    }

    function isURL(url) {

        var pattern = new RegExp('^(https?:\\/\\/)?'				// protocol
            + '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'	// domain name
            + '((\\d{1,3}\\.){3}\\d{1,3}))'							// OR ip (v4) address
            + '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'						// port and path
            + '((\\?|&)[;&a-z\\d%_.~+=-]*)?'						// query string
            + '(\\#[-a-z\\d_]*)?$', 'i'								// fragment locator
        );
        if (pattern.test(url)) {
            return true;
        } else {
            return false;
        }
    }

    function extension(path) {

        return path.split('.').pop();
    }

    function path2png(path) {

        var extension = path.split('.').pop();
        var filename = basename(path, '.' + extension);

        if (filename.length > 10) {
            filename = filename.substring(0, 9) + '…';
        }

        // Create SVG
        var $canvas = $('<canvas height="80" width="100" />')
            .attr('id', 'paf_canvas')
            .addClass('hidden')
        ;
        // Append to body
        $('body').append($canvas);
        // Draw
        var canvas = $canvas.get(0);
        var context = canvas.getContext("2d");
        // Background
        context.fillStyle = "#444";
        context.fillRect(0, 0, 100, 100);
        // Text
        context.textAlign = 'center';
        context.fillStyle = "#FFF";
        context.font = "bold 30px Arial";
        context.fillText('.' + extension, 50, 60);
        context.font = "bold 12px Arial";
        context.fillText(filename, 50, 25);
        // Store
        r = canvas.toDataURL('image/png');
        // Remove from document
        $canvas.remove();
        // Return
        return r;
    }

    function isNumber(n) {

        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function basename(path, suffix) {
        var b = path;
        var lastChar = b.charAt(b.length - 1);
        if (lastChar === '/' || lastChar === '\\') {
            b = b.slice(0, -1)
        }
        b = b.replace(/^.*[\/\\]/g, '');
        if (typeof suffix === 'string' && b.substr(b.length - suffix.length) == suffix) {
            b = b.substr(0, b.length - suffix.length)
        }
        return b
    }

    function explode(delimiter, string, limit) {
        if (arguments.length < 2 || typeof delimiter === 'undefined' || typeof string === 'undefined') return null;
        if (delimiter === '' || delimiter === false || delimiter === null) return false;
        if (typeof delimiter === 'function' || typeof delimiter === 'object' || typeof string === 'function' || typeof string === 'object') {
            return {0: ''}
        }
        if (delimiter === true) delimiter = '1';
        delimiter += '';
        string += '';
        var s = string.split(delimiter);
        if (typeof limit === 'undefined') return s;
        if (limit === 0) limit = 1;
        if (limit > 0) {
            if (limit >= s.length) return s;
            return s.slice(0, limit - 1).concat([s.slice(limit - 1).join(delimiter)])
        }
        if (-limit >= s.length) return [];
        s.splice(s.length + limit);
        return s
    }
});
