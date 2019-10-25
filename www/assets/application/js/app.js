(function (window, jquery) {
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
        });

        return $todoItem;
    }

    jquery.ajax('/mocks/todos/list.json').done(function (data) {
        console.log(data);
        const $todoList = jquery('.todo-list');
        data.data.forEach(function (item, index) {
            const $todoItem = createItem(item);
            $todoList.append($todoItem);
        })
    });
})(window, window.jQuery);
