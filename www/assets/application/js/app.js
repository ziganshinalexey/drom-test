const ENTER_KEY_CODE = 13;
const LIST_URL = '/todo/list';
const CREATE_URL = '/todo/create';
const REMOVE_URL = '/todo/remove';

(function (window, jquery) {
    const $todoList = jquery('.todo-list');

    sendIndexRequest();

    jquery('.new-todo').on('keypress', function (event) {
        if (ENTER_KEY_CODE !== event.keyCode) {
            return;
        }

        const input = event.currentTarget;
        const data = {
            name: input.value,
            isCompleted: false
        };

        sendCreateRequest(data);

        jquery(input).val(null);
    });

    jquery('.filter').on('click', function (event) {
        const $buttonList = jquery('.filter');
        $buttonList.each(function (index, item) {
            jquery(item).removeClass('selected');
        });

        const $currentButton = jquery(event.currentTarget);
        const isCompleted = event.currentTarget.value;
        $currentButton.toggleClass('selected');

        sendIndexRequest(isCompleted);
    });

    function sendIndexRequest (isCompleted) {
        jquery.ajax({
            url: LIST_URL,
            data: '' === isCompleted ? null : {isCompleted}
        }).done(function (data) {
            const $list = jquery('.todo-list li');
            $list.each(function (index, item) {
                jquery(item).remove();
            });

            data.data.forEach(function (item) {
                createItem(item);
            });
            calculateItems();
        });
    }

    function sendCreateRequest (data) {
        const request = {
            url: CREATE_URL,
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(data)
        };

        return jquery.ajax(request).done(function (data) {
            const responseObject = data.data;
            if (responseObject) {
                createItem(responseObject);
            }
        });
    }

    function sendRemoveRequest (id) {
        const request = {
            url: REMOVE_URL,
            data: {id: id}
        };

        return jquery.ajax(request).done(function (data) {
            const isSuccess = data.data.isSuccess;
            if (isSuccess) {
                removeItem(id);
                calculateItems();
            }
        });
    }

    function removeItem (id) {
        const $li = jquery('.item-' + id);
        $li.remove();
    }

    function createItem (item) {
        const template = `
            <li class="item-${item.id}${item.isCompleted ? ' completed' : ''}">
                <div class="view">
                    <input class="toggle" type="checkbox" ${item.isCompleted ? ' checked="checked"' : ""}>
                    <label>${item.name}</label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="${item.name}">
            </li>
        `;
        const $todoItem = jquery(template);

        $todoItem.find('label').on('dblclick', function (event) {
            const $list = jquery('.todo-list li');
            $list.each(function (index, item) {
                jquery(item).removeClass('editing');
            });
            const $li = $(this).parents('li');
            $li.toggleClass('editing');

            const $input = $li.find('.edit');
            const thisVal = $input.val();
            $input.val('').val(thisVal);
            $input.focus();
        });

        $todoItem.find('.edit').on('keypress', function (event) {
            if (ENTER_KEY_CODE !== event.keyCode) {
                return;
            }

            const $input = jquery(event.currentTarget);
            const $li = $input.parent();
            $li.toggleClass('editing');

            const $label = $li.find('label').text($input.val());

            const data = {
                id: item.id,
                name: $input.val(),
                isCompleted: item.isCompleted,
            };
        });

        $todoItem.find('.toggle').on('change', function (event) {
            const $target = jquery(event.currentTarget);
            $target.parents('.item-' + item.id).toggleClass('completed');

            const data = {
                id: item.id,
                name: item.name,
                isCompleted: $target.prop('checked'),
            };
        });

        $todoItem.find('.destroy').on('click', function (event) {
            sendRemoveRequest(item.id);
        });

        $todoList.append($todoItem);
        calculateItems();
    }

    function calculateItems () {
        const itemsCount = jquery('.todo-list li').length;
        const $strong = jquery('.todo-count strong').text(itemsCount);
    }
})(window, window.jQuery);
