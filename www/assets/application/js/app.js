const ENTER_KEY_CODE = 13;
const LIST_URL = '/todo/list';
const CREATE_URL = '/todo/create';
const REMOVE_URL = '/todo/remove';

(function (window, jquery) {
    const $todoList = jquery('.todo-list');

    jquery.ajax(LIST_URL).done(function (data) {
        data.data.forEach(function (item) {
            createItem(item);
        });
        calculateItems();
    });

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
            console.log(isSuccess);
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
                <input class="edit" value="Rule the web">
            </li>
        `;
        const $todoItem = jquery(template);

        $todoItem.find('.toggle').on('change', function (event) {
            // TODO: do ajax
            const $target = jquery(event.currentTarget);
            $target.parents('.item-' + item.id).toggleClass('completed');
        });

        $todoItem.find('.destroy').on('click', function (event) {
            const className = $todoItem.attr('class');
            const id = className.substr(className.indexOf('-') + 1);

            sendRemoveRequest(id);
        });

        $todoList.append($todoItem);
        calculateItems();
    }

    function calculateItems () {
        const itemsCount = jquery('.todo-list li').length;
        const $strong = jquery('.todo-count strong').text(itemsCount);
    }
})(window, window.jQuery);
