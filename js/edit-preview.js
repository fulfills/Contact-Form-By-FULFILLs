function update_preview() {
    (function($) {
        var $change_p = $('ul.change-p');

        function text_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td><input type="text" name="test" value=""></td>';
            str += '</tr>';
            return str;
        }

        function textarea_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td><textarea name="test"></textarea></td>';
            str += '</tr>';
            return str;
        }

        function email_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td><input type="email" name="test" value=""></td>';
            str += '</tr>';
            return str;
        }

        function tel_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td><input type="tel" name="test" value=""></td>';
            str += '</tr>';
            return str;
        }

        function address_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td><input type="tel" name="test" value="" placeholder="郵便番号">';
            str += '<input type="tel" name="test" value="" placeholder="都道府県">';
            str += '<input type="tel" name="test" value="" placeholder="市区町村番地">';
            str += '<input type="tel" name="test" value="" placeholder="マンション・ビル名"></td>';
            str += '</tr>';
            return str;
        }

        function radio_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td>';
            var $radio_s = $this.find('*[name$="[radio][]"]');
            $radio_s.each(function(){
            str += '<label><input type="radio" name="test">'+$(this).val()+'</label>';
            });
            str += '</td>';
            str += '</tr>';
            return str;
        }

        function check_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+($this.find('*[name$="[req]"]').prop('checked') ? '<span class="req">'+cfbf_dic['Required']+'</span>' : '')+'</td>';
            str += '<td>';
            var $check_s = $this.find('*[name$="[check][]"]');
            $check_s.each(function(){
            str += '<label><input type="checkbox" name="test">'+$(this).val()+'</label>';
            });
            str += '</td>';
            str += '</tr>';
            return str;
        }

        function select_preview($this) {
            var str = '<tr>';
            str += '<td class="cfbf-title">'+$this.find('*[name$="[title]"]').val()+'</td>';
            str += '<td><select name="test">';
            var $radio_s = $this.find('*[name$="[select][]"]');
            $radio_s.each(function(){
            str += '<option value="">'+$(this).val()+'</option>';
            });
            str += '</select></td>';
            str += '</tr>';
            return str;
        }

        var str = '<table><tbody>';
        $change_p.children().each(function(){
        var $c = $(this);
        var this_type = $c.find('*[name$="[type]"]').val();
        if(this_type === 'text') str += text_preview($c);
        else if(this_type === 'textarea') str += textarea_preview($c);
        else if(this_type === 'email') str += email_preview($c);
        else if(this_type === 'tel') str += tel_preview($c);
        else if(this_type === 'address') str += address_preview($c);
        else if(this_type === 'radio') str += radio_preview($c);
        else if(this_type === 'check') str += check_preview($c);
        else if(this_type === 'select') str += select_preview($c);
        });
        str += '</tbody></table>';
        str += '<input type="submit" value="'+cfbf_dic['SEND']+'">';
        $('div.preview').html(str);
    })(jQuery);
}

update_preview();