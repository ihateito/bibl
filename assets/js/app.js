$(function () {

    $('#jsGrid').jsGrid({
        width: '100%',
        height: '100%',
        autoload: true,

        filtering: true,
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
    
        controller: {
            loadData: function(filter) {
                return $.ajax({
                    type: "GET",
                    url: "/load",
                    data: filter,
                    dataType: "json"
                });
            },
    
            insertItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/insert",
                    data: item,
                    dataType: "json"
                });
            },
    
            updateItem: function(item) {
                return $.ajax({
                    type: "PUT",
                    url: "/update",
                    data: item,
                    dataType: "json"
                });
            },
    
            deleteItem: function(item) {
                return $.ajax({
                    type: "DELETE",
                    url: "/delete",
                    data: item,
                    dataType: "json"
                });
            }
        },

        fields: [
            {name: "id", type: "number", visible: false},
            {
                name: 'name',
                type: 'text',
                title: 'Название',
                width: 150,
                validate: {
                    validator: "required",
                }
            },
            {
                name: 'author',
                type: 'text',
                title: 'Автор',
                width: 50,
            },
            {
                name: 'year',
                type: 'text',
                title: 'Год',
                width: 30,
            },
            {
                name: 'discription',
                type: 'text',
                title: 'Описание',
                valueField: 'Id',
                textField: 'Name',
            },
            {
                name: 'isbn',
                type: 'text',
                title: 'ISBN',
                sorting: false,
            },
            {
                name: 'annotation',
                type: 'textarea',
                title: 'Аннотация',
                sorting: false,
                width: 200
            },
            {
                type: 'control'
            },
        ],
    })
})