function removeElement(id,type) {
    $("#"+id).remove();
    $.ajax({
        type: "POST",
        url: '../ajax/remove.php',
        data: {
            'id': id,
            'type': type
        }
    });
}

