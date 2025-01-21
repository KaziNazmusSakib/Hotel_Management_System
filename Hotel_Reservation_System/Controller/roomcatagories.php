<?php
require_once('../Model/categoryModel.php');

function listCategories() {
    return getAllCategories();
}

function manageCategories($action, $data) {
    if ($action === 'create') {
        return createCategory($data);
    }
    if ($action === 'update') {
        return updateCategory($data['id'], $data);
    }
    if ($action === 'delete') {
        return deleteCategory($data['id']);
    }
    return false;
}
?>
