<?php

return [

    //===========================================================
    // FAILED API
    //===========================================================
    'failed' => 'There is some thing wrong, please try again',


    //===========================================================
    // AUTHORIZATION
    //===========================================================
    'authorization' => 'you are not authorized',


    //===========================================================
    // AUTHENTICATED
    //===========================================================
    'login' => 'You are logged in successfully',
    'password.mismatch' => 'Password mismatch',
    'register' => 'successfully registered',
    'logout' => 'Signed out successfully',


    //===========================================================
    // AUTH CUSTOMER
    //===========================================================
    'AuthCustomer.email.required' => 'The email is required',
    'AuthCustomer.email.email' => 'Please enter a valid email',
    'AuthCustomer.email.exists' => 'This email is not registered in our system',
    'AuthCustomer.email.unique' => 'This email was already taken',
    'AuthCustomer.password.required' => 'The password is required',
    'AuthCustomer.password.string' => 'The password should be some character',
    'AuthCustomer.password.min' => 'The password should be at least 6 character',
    'AuthCustomer.name.required' => 'The name of customer is required',
    'AuthCustomer.name.string' => 'The name of customer should be string',
    'AuthCustomer.name.max' => 'The name of customer is too big',
    'AuthCustomer.password.max' => 'The password should be maxim 30 character ',
    'AuthCustomer.nick_name.required' => 'Nick name is required',
    'AuthCustomer.nick_name.string' => 'Nick name is should be a string',
    'AuthCustomer.nick_name.max' => 'Nick name is too long',
    'AuthCustomer.date_of_birth.required' => 'Date of birth is required',
    'AuthCustomer.date_of_birth.string' => 'Date of birth is should be a string',
    'AuthCustomer.date_of_birth.max' => 'Date of birth is too long',
    'AuthCustomer.phone.required' => 'Phone number is required',
    'AuthCustomer.phone.min' => 'Phone number is too short',
    'AuthCustomer.phone.max' => 'Phone number is too long',
    'AuthCustomer.image.mimes' => 'The image extension must be: jpeg, png, jpg, gif, svg',
    'AuthCustomer.image.max' => 'The image size is so big',
    'AuthCustomer.email.max' => 'The email customer is too long',
    'AuthCustomer.info' => 'This is the customer info',
    'AuthCustomer.email.taken' => 'This email was taken',
    'AuthCustomer.email.taken.not' => 'This email was not taken yet',
    'AuthCustomer.found' => 'The customer is not exist',
    'AuthCustomer.all' => 'All customers have been successfully restored',
    'AuthCustomer.one' => 'Customer restored successfully',
    'AuthCustomer.create' => 'Customer created was success',
    'AuthCustomer.update' => 'The customer was updated',
    'AuthCustomer.deleted' => 'The customer was deleted',


    //===========================================================
    // AUTH Dashboard
    //===========================================================
    'AuthDashboard.email.required' => 'The email is required',
    'AuthDashboard.email.exists' => 'This email is not registered in our system',
    'AuthDashboard.email.email' => 'Please enter a valid email',
    'AuthDashboard.password.required' => 'Password is required',
    'AuthDashboard.password.string' => 'Password should contain at lest 6 character',
    'AuthDashboard.password.min' => 'Password should contain at lest 6 character',
    'AuthDashboard.name.required' => 'The name is required',
    'AuthDashboard.name.string' => 'The name should be string',
    'AuthDashboard.name.max' => 'The name is too long',
    'AuthDashboard.email.unique' => 'This email is already taken',
    'AuthDashboard.password.max' => 'Password should be at max 32 character',


    //===========================================================
    // CATEGORY
    //===========================================================
    'category.name.required' => 'The name of category is required',
    'category.name.string' => 'The name of category should be string',
    'category.name.max' => 'The name of category is too big',
    'category.name.unique' => 'The name of category is required',
    'category.image.required' => 'The image of category is required',
    'category.image.mimes' => 'The image extension must be: jpeg, png, jpg, gif, svg',
    'category.image.max' => 'The image size is so big',
    'category.all' => 'All categories have been successfully restored',
    'category.one' => 'category restored successfully',
    'category.found' => 'The category is not exist',
    'category.create' => 'Category created was success',
    'category.update' => 'The category was updated',
    'category.deleted' => 'The category was deleted',


    //===========================================================
    // CART ITEM
    //===========================================================
    'cartItem.product_id.required' => 'Product id is required',
    'cartItem.product_id.numeric' => 'Product id should be a numeric',
    'cartItem.product_id.exists' => 'Product id is invalid',
    'cartItem.color_id.required' => 'Color id is required',
    'cartItem.color_id.numeric' => 'Color id should be a numeric',
    'cartItem.color_id.exists' => 'Color id is invalid',
    'cartItem.size_id.numeric' => 'Size id should be numeric',
    'cartItem.size_id.exists' => 'Size id is invalid',
    'cartItem.quantity.required' => 'Quantity is required',
    'cartItem.quantity.numeric' => 'Quantity should be numeric',
    'cartItem.quantity.min' => 'Quantity should be at least 1 item',
    'cartItem.quantity.max' => 'This quantity not available right now',
    'cartItem.address_id.required' => 'Address id is required',
    'cartItem.address_id.numeric' => 'Address id should be a numeric',
    'cartItem.address_id.exists' => 'Address id is invalid',
    'cartItem.shippingType_id.required' => 'Shipping type is required',
    'cartItem.shippingType_id.numeric' => 'Shipping type should be numeric',
    'cartItem.shippingType_id.exists' => 'shipping type is invalid',
    'cartItem.all' => 'All cart items have been successfully restored',
    'cartItem.one' => 'cart Item restored successfully',
    'cartItem.found' => 'The cart item is not exist',
    'cartItem.create' => 'Item add to cart successfully',
    'cartItem.update' => 'The cart item was updated',
    'cartItem.deleted' => 'The cart item was deleted',


    //===========================================================
    // ADDRESS
    //===========================================================
    'address.title.required' => 'Title is required',
    'address.title.string' => 'Title should be string',
    'address.title.max' => 'Title is too long',
    'address.title.min' => 'Title should be at least 1 character',
    'address.address.required' => 'Address is required',
    'address.address.string' => 'Address should be string',
    'address.address.max' => 'Address is too long',
    'address.default.numeric' => 'Default should be 0 or 1',
    'address.default.between' => 'Default should be 0 or 1',
    'address.address.min' => 'Address should be at least 1 character',
    'address.address_id.required' => 'Address id is required',
    'address.address_id.numeric' => 'Address id should be numeric',
    'address.address_id.exists' => 'Address id is invalid',
    'address.all' => 'All address have been successfully restored',
    'address.customer.all' => 'All address for customer have been successfully restored',
    'address.one' => 'Address restored successfully',
    'address.found' => 'The address is not exist',
    'address.create' => 'Address created was success',
    'address.update' => 'The address was updated',
    'address.deleted' => 'The address was deleted',
    'address.default.set' => 'The address was set default',
    'address.default.get' => 'Address default restored successfully',
    'address.default.get,failed' => 'There is not any default address',


    //===========================================================
    // COLOR
    //===========================================================
    'color.product_id.required' => 'Product id is required',
    'color.product_id.numeric' => 'Product id should be numeric',
    'color.product_id.exists' => 'Product id is invalid',
    'color.color.required' => 'The color is required',
    'color.color.min' => 'The color should be 3 character at least',
    'color.color.max' => 'The color should be 6 character at most',
    'color.all' => 'All colors have been successfully restored',
    'color.one' => 'Color restored successfully',
    'color.found' => 'The color is not exist',
    'color.create' => 'Color created was success',
    'color.update' => 'The color was updated',
    'color.deleted' => 'The color was deleted',


    //===========================================================
    // SIZE
    //===========================================================
    'size.product_id.required' => 'Product id is required',
    'size.product_id.numeric' => 'Product id should be numeric',
    'size.product_id.exists' => 'Product id is invalid',
    'size.size.required' => 'The size is required',
    'color.size.max' => 'The size is too long',
    'size.all' => 'All sizes have been successfully restored',
    'size.one' => 'Size restored successfully',
    'size.found' => 'The size is not exist',
    'size.create' => 'Size created was success',
    'size.update' => 'The size was updated',
    'size.deleted' => 'The size was deleted',


    //===========================================================
    // FORGET PASSWORD
    //===========================================================
    'forgetPassword.email.required' => 'The email is required',
    'forgetPassword.email.email' => 'Please enter a valid email',
    'forgetPassword.email.exists' => 'This email is invalid',
    'forgetPassword.code.required' => 'The code is required',
    'forgetPassword.code.numeric' => 'The code should be numbers only',
    'forgetPassword.code.exists' => 'code is invalid',
    'forgetPassword.code.max' => 'The code should be 6 character',
    'forgetPassword.code.min' => 'The code should be 6 character',
    'forgetPassword.code.expired' => 'The code was expired',
    'forgetPassword.code.valid' => 'The code is valid',
    'forgetPassword.password.required' => 'Password is required',
    'forgetPassword.password.string' => 'Password should be some character',
    'forgetPassword.password.min' => 'Password should be at least 6 character',
    'forgetPassword.message.sent' => 'Message sent successfully, Check your inbox',
    'forgetPassword.password.reset' => 'password has been successfully reset',


    //===========================================================
    // IMAGE
    //===========================================================
    'image.images.required' => 'The images is required',
    'image.images.array' => 'The images should be an array',
    'image.images.*.required' => 'The image is required',
    'image.images.*.mimes' => 'The image extension must be: jpeg, png, jpg, gif, svg',
    'image.images.*.max' => 'The image size is so big',
    'image.all' => 'All images have been successfully restored',
    'image.one' => 'Image restored successfully',
    'image.found' => 'The image is not exist',
    'image.create' => 'Image created was success',
    'image.update' => 'The image was updated',
    'image.deleted' => 'The image was deleted',


    //===========================================================
    // ORDER
    //===========================================================
    'order.product_id.required' => 'Product id is required',
    'order.product_id.numeric' => 'Product id should be numeric',
    'order.product_id.exists' => 'Product id is invalid',
    'order.color_id.required' => 'Color id is required',
    'order.color_id.numeric' => 'Color id should be numeric',
    'order.color_id.exists' => 'Color id is invalid',
    'order.size_id.numeric' => 'size id should be numeric',
    'order.size_id.exists' => 'Size id is invalid',
    'order.address_id.required' => 'Address id is required',
    'order.address_id.numeric' => 'Address id is numeric',
    'order.address_id.exists' => 'Address id is invalid',
    'order.shippingType_id.required' => 'Shipping type id is required',
    'order.shippingType_id.numeric' => 'Shipping type id should be numeric',
    'order.shippingType_id.exists' => 'Shipping type id is invalid',
    'order.quantity.required' => 'Quantity is required',
    'order.quantity.numeric' => 'Quantity should be numeric',
    'order.quantity.min' => 'Quantity should be at least 1 item',
    'order.quantity.max' => 'This quantity not available',
    'order.order_id.required' => 'Order id is required',
    'order.order_id.numeric' => 'Order id should be numeric',
    'order.order_id.exists' => 'Order id is invalid',
    'order.accept.required' => 'Accept is required',
    'order.accept.boolean' => 'Accept should be boolean(true ,1 Or false ,0)',
    'order.all' => 'All orders have been successfully restored',
    'order.one' => 'Order restored successfully',
    'order.found' => 'The order is not exist',
    'order.create' => 'Order created was success',
    'order.update' => 'The order was updated',
    'order.deleted' => 'The order was deleted',
    'order.shipping'=>'This order is already in shipping stage',
    'order.shipped'=>'This order has already been shipped',
    'order.rejected'=>'This order is already reject before',
    'order.transfer.reject'=>'The order was rejected',
    'order.transfer.shipping'=>'The order has been successfully transferred to the shipping stage',


    //===========================================================
    // PRODUCT
    //===========================================================
    'product.name.required' => 'The name of product is required',
    'product.name.string' => 'The name of product should be string',
    'product.name.min' => 'The name should be at least 1 character',
    'product.name.unique' => 'This product is already exist',
    'product.category_id.required' => 'The category id is required to know this product is exist in any category',
    'product.category_id.numeric' => 'The category id should be a numbers only',
    'product.category_id.exists' => 'This category is not exist',
    'product.price.required' => 'The price of product is required',
    'product.price.numeric' => 'The price should be a numbers only',
    'product.price.min' => 'The price should be 1$ at least',
    'product.quantity.required' => 'The quantity is required',
    'product.quantity.numeric' => 'The quantity should be a numbers only',
    'product.quantity.min' => 'The should be at least 0',
    'product.description.required' => 'The description of product is required',
    'product.description.string' => 'The description should be a string',
    'product.description.min' => 'The description of product should be at lest 10 character',
    'product.images.required' => 'The images for product is required',
    'product.images.array' => 'Images should be an array',
    'product.images.*.required' => 'The image is required',
    'product.images.*.mimes' => 'The file extension should be jpeg, png, jpg, gif or svg',
    'product.images.*.max' => 'The file size is so big',
    'product.colors.required' => 'The colors is required',
    'product.colors.array' => 'The colors should be an array',
    'product.sizes.array' => 'The sizes should be an array',
    'product.sizes.*.min' => 'The size should be at least 1 character',
    'product.sizes.*.max' => 'The size is too long',
    'product.toSearch.required' => 'Please fill the search field',
    'product.toSearch.max' => 'Please enter less than 255 character in search field',
    'product.toSearch.string' => 'You should search about some product by his name',
    'product.all' => 'All products have been successfully restored',
    'product.one' => 'Product restored successfully',
    'product.found' => 'The product is not exist',
    'product.create' => 'Product created was success',
    'product.update' => 'The product was updated',
    'product.deleted' => 'The product was deleted',

    //===========================================================
    // PRODUCT LIKE
    //===========================================================
    'like.all' => 'All products the customers like',
    'like.customer.product' => 'The products the customer like',
    'like.true' => 'The customer like the product',
    'like.false' => 'The customer does\'nt like the product',
    'like.create' => 'like created was success',
    'like.deleted' => 'The like was deleted',



    //===========================================================
    // SHIPPING TYPE
    //===========================================================
    'shippingType.title.required' => 'Title is required',
    'shippingType.title.string' => 'Title should be a string',
    'shippingType.title.min' => 'Title should be at lest 1 character',
    'shippingType.title.max' => 'Title is too long',
    'shippingType.price.required' => 'Price is required',
    'shippingType.price.numeric' => 'Price should be numbers',
    'shippingType.price.min' => 'Price should be at lest 1$',
    'shippingType.minNumberDaysToArrival.required' => 'Min number days to arrival is required',
    'shippingType.minNumberDaysToArrival.numeric' => 'Min number days to arrival should be numbers',
    'shippingType.minNumberDaysToArrival.min' => 'Min number days to arrival should be at lest 1 day',
    'shippingType.minNumberDaysToArrival.max' => 'Min number days to arrival should be less than max number days to arrival',
    'shippingType.maxNumberDaysToArrival.required' => 'Max number days to arrival is required',
    'shippingType.maxNumberDaysToArrival.numeric' => 'Max number days to arrival should be numbers',
    'shippingType.maxNumberDaysToArrival.min' => 'Max number days to arrival should be bigger than min number days to arrival',
    'shippingType.all' => 'All shipping types have been successfully restored',
    'shippingType.one' => 'Shipping type restored successfully',
    'shippingType.found' => 'The shipping type is not exist',
    'shippingType.create' => 'Shipping type created was success',
    'shippingType.update' => 'The shipping type was updated',
    'shippingType.deleted' => 'The shipping type was deleted',
];
