function loadMyShoppingBin() {
    $.ajax({
        type: 'GET',
        url: '/handlers/shopping_bin_widget_reload_handler.php',
        success: function (callback) {
            $('#basket-value').html(callback)
        }
    })
}

function rebuildShoppingBin() {
    $.ajax({
        type: 'GET',
        url: '/handlers/shopping_bin_data_reload_handler.php',
        dataType: 'json',
        success: function (json) {
            $('#checkout').hide()

            let html_string
            let total_count = 0
            let total_price = 0

            if (json.length !== 0) {
                html_string = `
                <tr>
                    <td>
                        <p class="filter-label" style="text-align: center">Фото</p>
                    </td>
                    <td>
                        <p class="filter-label" style="text-align: center">ID</p>
                    </td>
                    <td>
                        <p class="filter-label" style="text-align: center">Наименование</p>
                    </td>
                    <td>
                        <p class="filter-label" style="text-align: center">Кол-во</p>
                    </td>
                    <td>
                        <p class="filter-label" style="text-align: center">Цена</p>
                    </td>
                    <td>
                        <p class="filter-label" style="text-align: center">Операции</p>
                    </td>
                </tr>`

                for (let i = 0; i < json.length; i++) {
                    let item = json[i]
                    total_count += parseInt(item['count'])
                    total_price += parseInt(item['price']) * parseInt(item['count'])

                    html_string = html_string.concat(
                        `<tr class="item-row"> 
                        <td style="width: 50px; height: 50px"> 
                            <img style="width: 50px; height: 50px" src="../images/item-images/${item['image']}"> 
                        </td>
                        <td>
                            <p class="item-name" style='text-align: center'>${item['id']}</p> 
                        </td>
                        <td style='padding: 2px 5px'> 
                            <div class='item-name'>
                                <a class='item-name link' href='item.php?id=${item['id']}'>${item['name']}</a>
                            </div> 
                        </td> 
                        <td>
                            <p class="item-price">${item['count']}</p>
                        </td>
                        <td>
                            <p class="item-price">${item['price'] * item['count']}₽</p>
                        </td>
                        <td style='width: 130px; padding: 5px'>
                            <a>
                                <img id="${item['id']}" class='basket-operation add-item' src='../resources/add.svg'>
                            </a>
                            <a>
                                <img id="${item['id']}" class='basket-operation remove-item' src='../resources/minus.svg'>
                            </a>
                            <a>
                                <img id="${item['id']}" class='basket-operation delete-item' src='../resources/remove.svg'>
                            </a>
                        </td>
                     </tr>`)
                }

                $('#checkout').show()
                $('.basket-result').text(`В Вашей корзине ${total_count} предмет(а) на ${total_price}₽.`)

            } else {
                html_string = `<tr><td colspan='6'><p class='empty'>Ничего не найдено!</p></td></tr>`
            }

            $('table#basket').html(html_string)
        }
    })
}

function addItemToShoppingBin(itemId, itemName) {
    if (itemName) {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': 1},
            success: function (callback) {
                callback = callback.replace('+', '\n')
                alert(callback)
                loadMyShoppingBin()
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': 1},
            success: function () {
                rebuildShoppingBin()
            }
        })
    }
}

function removeItemFromShoppingBin(itemId, itemName) {
    if (itemName) {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': -1},
            success: function (callback) {
                callback = callback.replace('+', '\n')
                alert(callback)
                loadMyShoppingBin()
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': -1},
            success: function () {
                rebuildShoppingBin()
            }
        })
    }
}

function deleteItemFromShoppingBin(itemId, itemName) {
    if (itemName) {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': 0},
            success: function (callback) {
                callback = callback.replace('+', '\n')
                alert(callback)
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: '/handlers/shopping_bin_item_management_handler.php',
            data: {'id': itemId, 'name': itemName, 'change': 0},
            success: function () {
                rebuildShoppingBin()
                loadMyShoppingBin()
            }
        })
    }
}





function applyItemFilters(filters) {

}
