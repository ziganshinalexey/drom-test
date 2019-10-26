const ENTER_KEY_CODE = 13;

(function (window, jquery) {
    const $todoList = jquery('.todo-list');

    function createItem (item) {
        const template = `
            <li class="item-${item.id}${item.isSuccess ? ' completed' : ''}">
                <div class="view">
                    <input class="toggle" type="checkbox" ${item.isSuccess ? ' checked="checked"' : ""}>
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
            // TODO: do ajax
            $todoItem.remove();
            calculateItems();
        });

        $todoList.append($todoItem);
        calculateItems();
    }

    function calculateItems () {
        const itemsCount = jquery('.todo-list li').length;
        const $strong = jquery('.todo-count strong').text(itemsCount);
    }

    jquery('.new-todo').on('keypress', function (event) {
        if (ENTER_KEY_CODE !== event.keyCode) {
            return;
        }

        const input = event.currentTarget;
        const newItem = {
            id: 1,
            name: input.value,
            isSuccess: false
        };
        createItem(newItem);
        jquery(input).val(null);
    });

    jquery.ajax('/todo/list').done(function (data) {
        console.log(data);
        data.data.forEach(function (item) {
            createItem(item);
        })
    });
})(window, window.jQuery);
