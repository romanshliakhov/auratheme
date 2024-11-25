function template (name) {
    switch (name) {
        default:
        case 'cta_box_template':
            return {
                title: 'CTA Box',
                body: [
                    {
                        type: 'textbox',
                        name: 'cta',
                        label: 'CTA text:',
                        multiline: true,
                        minHeight: 100,
                        classes: 'box-colored text-colored',
                    },
                    {
                        type: 'colorpicker',
                        name: 'text_color',
                        label: 'Text color:',
                        value: '#000',
                        minHeight: 100,
                        height: 100,
                        classes: 'text_color',
                        onchange: function (e) {
                            var els = document.getElementsByClassName('mce-box-colored');
                            var input = document.querySelector('.mce-text-color-value');

                            input.value = e.target.value();

                            for (var c = els.length; c--;) {
                                var el = els[c];

                                if (el && e.target.value()) {
                                    el.style = el.style.cssText + 'color:' + e.target.value();
                                }
                            }
                        },
                    },
                    {
                        type: 'textbox',
                        name: 'text_color_value',
                        label: 'Value: ',
                        value: '#000',
                        classes: 'text-color-value',
                        onkeyup: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0]._repaint();
                        },
                        onchange: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0]._repaint();
                        },
                    },
                    {
                        type: 'colorpicker',
                        name: 'bg_color',
                        label: 'Background color:',
                        value: '#fff',
                        minHeight: 100,
                        height: 100,
                        classes: 'bg_color',
                        onchange: function (e) {
                            var els = document.getElementsByClassName('mce-text-colored');
                            var input = document.querySelector('.mce-bg-color-value');

                            input.value = e.target.value();

                            for (var c = els.length; c--;) {
                                var el = els[c];

                                if (el && e.target.value()) {
                                    el.style = el.style.cssText + 'background-color:' + e.target.value();
                                }
                            }
                        },
                    },
                    {
                        type: 'textbox',
                        name: 'bg_color_value',
                        label: 'Value: ',
                        value: '#fff',
                        classes: 'bg-color-value',
                        onkeyup: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0]._repaint();
                        },
                        onchange: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0]._repaint();
                        },
                    },
                    {
                        type: 'checkbox',
                        name: 'is_subscribe_link',
                        label: 'Is subscribe link?:',
                        onchange: function (e) {
                            var conditionEls = document.getElementsByClassName('mce-condition-subscribe');

                            for (var c = conditionEls.length; c--;) {
                                var el = conditionEls[c];
                                var tagname = el.tagName.toLowerCase();

                                if (el && e.target.value()) {
                                    if (tagname !== 'input') {
                                        el.style = el.style.cssText + 'pointer-events: none;';
                                    } else {
                                        el.value = '';
                                        el.setAttribute('disabled', 'disabled');
                                    }
                                } else if (el && !e.target.value()) {
                                    el.style = el.style.cssText + 'pointer-events: auto;';
                                    el.removeAttribute('disabled');
                                }
                            }
                        },
                    },
                    {
                        type: 'textbox',
                        name: 'url',
                        label: 'URL:',
                        classes: 'condition-subscribe',
                    },
                    {
                        type: 'listbox',
                        name: 'a_target',
                        label: 'Link target:',
                        classes: 'condition-subscribe',
                        values: [
                            {text: 'Open in new window', value: '_blank'},
                            {text: 'Open in current window', value: '_self'},
                        ],
                    },
                    {
                        type: 'listbox',
                        name: 'cta_align',
                        label: 'Text align:',
                        values: [
                            {text: 'Left', value: 'left'},
                            {text: 'Center', value: 'center'},
                            {text: 'Right', value: 'right'},
                        ],
                    },
                    {
                        type: 'checkbox',
                        name: 'is_container_clickable',
                        label: 'Is entire CTA box clickable?:',
                    },
                ],
                onsubmit: function (e) {
                    var template = '',
                        containerClickable = e.data.is_container_clickable,
                        align = e.data.cta_align,
                        text = (!e.data.cta) ? 'CTA box text' : e.data.cta,
                        backgroundColor = e.data.bg_color,
                        textColor = e.data.text_color,
                        href = (!e.data.url) ? '#' : e.data.url,
                        aTarget = (!e.data.a_target || !e.data.url || e.data.is_subscribe_link) ? '_self' : e.data.a_target,
                        subscribeClass = (!e.data.is_subscribe_link) ? '' : 'open-newsletter-popup';

                    if (!containerClickable) {
                        template = '<div class="cta-custom-box" style="line-height: 1.5; text-align: ' + align + '">' +
                            '<span style="background-color: ' + backgroundColor + ';">' +
                            '<a target="' + aTarget + '" href="' + href + '" class="c-btn -secondary ' + subscribeClass + '">' +
                            '<span style="color: ' + textColor + ';">' + text + '</span></a>' +
                            '</span>' +
                            '</div>';
                    } else {
                        template = '<p style="line-height: 1.5; text-align: ' + align + ';">' +
                            '<a target="' + aTarget + '" href="' + href + '" style="background-color: ' + backgroundColor + ';" ' +
                            'class="cta-custom-box-link c-btn -secondary' + subscribeClass + '">' +
                            '<span style="color: ' + textColor + ';">' + text + '</span></a>' +
                            '</p>';
                    }

                    tinymce.activeEditor.insertContent(template);
                },
            };
        case 'color_text_box':
            return {
                title: 'CTA Box',
                body: [
                    {
                        type: 'textbox',
                        name: 'text',
                        label: 'Text:',
                        multiline: true,
                        minHeight: 100,
                        classes: 'box-colored text-colored',
                    },
                    {
                        type: 'colorpicker',
                        name: 'text_color',
                        label: 'Text color:',
                        value: '#000',
                        minHeight: 100,
                        height: 100,
                        classes: 'text_color',
                        onchange: function (e) {
                            var els = document.getElementsByClassName('mce-box-colored');
                            var input = document.querySelector('.mce-text-color-value');

                            input.value = e.target.value();

                            for (var c = els.length; c--;) {
                                var el = els[c];

                                if (el && e.target.value()) {
                                    el.style = el.style.cssText + 'color:' + e.target.value();
                                }
                            }
                        },
                    },
                    {
                        type: 'textbox',
                        name: 'text_color_value',
                        label: 'Value: ',
                        value: '#000',
                        classes: 'text-color-value',
                        onkeyup: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0]._repaint();
                        },
                        onchange: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#text_color')[0]._repaint();
                        },
                    },
                    {
                        type: 'colorpicker',
                        name: 'bg_color',
                        label: 'Background color:',
                        value: '#fff',
                        minHeight: 100,
                        height: 100,
                        classes: 'bg_color',
                        onchange: function (e) {
                            var els = document.getElementsByClassName('mce-text-colored');
                            var input = document.querySelector('.mce-bg-color-value');

                            input.value = e.target.value();

                            for (var c = els.length; c--;) {
                                var el = els[c];

                                if (el && e.target.value()) {
                                    el.style = el.style.cssText + 'background-color:' + e.target.value();
                                }
                            }
                        },
                    },
                    {
                        type: 'textbox',
                        name: 'bg_color_value',
                        label: 'Value: ',
                        value: '#fff',
                        classes: 'bg-color-value',
                        onkeyup: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0]._repaint();
                        },
                        onchange: function (e) {
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0].color().parse(e.target.value);
                            tinymce.activeEditor.windowManager.windows[0].find('#bg_color')[0]._repaint();
                        },
                    },
                    {
                        type: 'listbox',
                        name: 'align',
                        label: 'Text align:',
                        values: [
                            {text: 'Left', value: 'left'},
                            {text: 'Center', value: 'center'},
                            {text: 'Right', value: 'right'},
                        ],
                    },
                ],
                onsubmit: function (e) {
                    var align = e.data.text,
                        text = (!e.data.text) ? 'Color text box' : e.data.text,
                        backgroundColor = e.data.bg_color,
                        textColor = e.data.text_color,
                        template = '<div class="cta-custom-box" style="line-height: 1.5; text-align: ' + align + '">' +
                            '<span style="background-color: ' + backgroundColor + ';">' +
                            '<span style="color: ' + textColor + ';">' + text + '</span>' +
                            '</span></div>';

                    tinymce.activeEditor.insertContent(template);
                },
            };
    }
}



(function() {
    tinymce.PluginManager.add('wdm_mce_button', function (editor) {
        // Add a button that opens a window
        editor.addButton('wdm_mce_button', {
            tooltip: 'Insert CTA',
            text: 'CTA',
            icon: false,
            paste_as_text: true,
            relative_urls: false,
            onclick: function () {
                // Open window
                editor.windowManager.open({
                    title: 'Insert CTA',
                    body: [
                        {
                            type: 'listbox',
                            values: [
                                {text: 'CTA Box', value: 'cta_box_template'},
                                {text: 'Color text Box(Like CTA)', value: 'color_text_box'},
                            ],
                            name: 'template',
                            minWidth: 200,
                            label: 'Choose template:',
                        },
                    ],
                    onsubmit: function (e) {
                        editor.windowManager.open(template(e.data.template));
                    },
                });
            },
        });
    });
})();