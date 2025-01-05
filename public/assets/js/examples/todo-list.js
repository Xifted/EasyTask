$(function () {
    $(document).on('click', '.todo-check-all', function () {
        let listCheckbox = $('.todo-list ul li input[type="checkbox"]');
        listCheckbox.prop('checked', $(this).prop('checked'));
        if ($(this).prop('checked')) {
            listCheckbox.closest('li').addClass('active');
        } else {
            listCheckbox.closest('li').removeClass('active');
        }
    });
    
    $(document).on('click', '.todo-list ul li input[type="checkbox"]', function () {
        if ($(this).prop('checked')) {
            $(this).closest('li').addClass('active');
        } else {
            $(this).closest('li').removeClass('active');
        }
    });
    
    $(document).on('click', '#delete-selected', function () {
        let selectedTasks = $('.todo-list ul li input[type="checkbox"]:checked')
            .map(function () {
                return $(this).val();
            })
            .get();
    
        if (selectedTasks.length > 0) {
            if (confirm('Are you sure you want to delete the selected tasks?')) {
                let form = $('#delete-form');
                form.append(
                    selectedTasks
                        .map(id => `<input type="hidden" name="task_ids[]" value="${id}">`)
                        .join('')
                );
                form.submit();
            }
        } else {
            alert('Please select at least one task to delete.');
        }
    });
    

    // $(document).on('click', '.todo-list ul li', function (e) {
    //     let url = $(this).data('detail-url'),
    //         target = e.target;
    //     if (target.nodeName != 'INPUT' && target.nodeName != 'LABEL' && !$(target).hasClass('add-star') && !$(target).hasClass('todo-sortable-handle')&& !$(target).hasClass('dropdown')) {
    //         window.location.href = url;
    //     }
    // });

    if ($('.todo-textarea-editor').length) {
        new Quill('.todo-textarea-editor', {
            modules: {
                toolbar: ".todo-textarea-toolbar"
            },
            placeholder: "Type something... ",
            theme: "snow"
        });
    }
    if ($('.todo-textarea-editor2').length) {
        new Quill('.todo-textarea-editor2', {
            modules: {
                toolbar: ".todo-textarea-toolbar2"
            },
            placeholder: "Type something... ",
            theme: "snow"
        });
    }

    // Todo sortable
    if($('.todo-list').length) {
        $('.todo-list ul').sortable({
            axis: "y",
            cursor: "move",
            handle: '.todo-sortable-handle'
        }).disableSelection();
    }

    // Timepicker
    $('.task-time-input').clockpicker({
        autoclose: true
    });

    // Datapicker
    $('.task-datepicker-input').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    // Select2
    $('.task-tags-input').select2({
        placeholder: 'Select'
    });
});
