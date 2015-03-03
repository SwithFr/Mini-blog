<?php

# Public
$routes['default'] = 'index/post';
$routes['viewPost'] = 'view/post';
$routes['categoryPost'] = 'category/post';
$routes['createComment'] = 'create/comment';
$routes['checkUser'] = 'check/user';
$routes['disconnectUser'] = 'disconnect/user';

# Admin - Posts
$routes['ad_indexPost'] = 'admin_index/post';
$routes['ad_createPost'] = 'admin_create/post';
$routes['ad_updatePost'] = 'admin_update/post';
$routes['ad_deletePost'] = 'admin_delete/post';

# Admin - Comments
$routes['ad_indexComment'] = 'admin_index/comment';
$routes['ad_deleteComment'] = 'admin_delete/comment';

# Admin - Categoies
$routes['ad_indexCategory'] = 'admin_index/category';
$routes['ad_createCategory'] = 'admin_create/category';
$routes['ad_deleteCategory'] = 'admin_delete/category';