let TasksList = function () {

    let handleTable = function () {
        let table = new Tabulator('#task-list', {
            columns: [

            ]
        })
    };

    return {
        init: function () {

        }
    }
}();

jQuery(document).ready(function () {
    TasksList.init();
});