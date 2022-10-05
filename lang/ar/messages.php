<?php

return [

    //===========================================================
    // FAILED API
    //===========================================================
    'failed' => 'فشلت العملية يوجد خطأ ما, الرجاء المحاولة مرة اخرى',


    //===========================================================
    // AUTHORIZATION
    //===========================================================
    'authorization' => 'غير مسموح لك بالوصول',


    //===========================================================
    // AUTHENTICATED
    //===========================================================
    'login' => 'تم تسجيل الدخول بنجاح',
    'password.mismatch' => 'كلمة السر غير متطابقة',
    'register' => 'تم التسجيل بنجاح',
    'logout' => 'تم تسجيل الخروج بنجاح',


    //===========================================================
    // AUTH CUSTOMER
    //===========================================================
    'AuthCustomer.email.required' => 'البريد الالكتروني مطلوب',
    'AuthCustomer.email.email' => 'الرجاء ادخال بريد الكتروني صالح',
    'AuthCustomer.email.exists' => 'هذا البريد غير مسجل',
    'AuthCustomer.email.unique' => 'هذا البريد مستخدم بالفعل',
    'AuthCustomer.password.required' => 'كلمة المرور مطلوبة',
    'AuthCustomer.password.string' => 'يجب ان تكون كلمة المرور عبارة عن بعض الحروف او الارقام او الرموز',
    'AuthCustomer.password.min' => 'يجب ان تكون كلمة السر 6 خانات',
    'AuthCustomer.name.required' => 'اسم الزبون مطلوب',
    'AuthCustomer.name.string' => 'يجب ان يكون اسم الزبون نص',
    'AuthCustomer.name.max' => 'اسم الزبون كبير جدا',
    'AuthCustomer.password.max' => 'يجب ان تكون كلمة المرور 32 خانة على الاكثر',
    'AuthCustomer.nick_name.required' => 'اسم الزبون المستعار مطلوب',
    'AuthCustomer.nick_name.string' => 'يجب ان يكون الاسم المستعار لزبون نص',
    'AuthCustomer.nick_name.max' => 'اسم الزبون المستعار كبير جدا',
    'AuthCustomer.date_of_birth.required' => 'تاريخ الميلاد مطلوب',
    'AuthCustomer.date_of_birth.string' => 'يجب ادخال تاريخ الميلاد بشكل صحيح',
    'AuthCustomer.date_of_birth.max' => 'تاريخ الميلاد اكبر من اللازم',
    'AuthCustomer.phone.required' => 'رقم الهاتف مطلوب',
    'AuthCustomer.phone.min' => 'رقم الهاتف اقل من اللازم',
    'AuthCustomer.phone.max' => 'رقم الهاتف اكبر من اللازم',
    'AuthCustomer.image.mimes' => 'امتداد الصورة يجب ان يكون: jpeg, png, jpg, gif, svg',
    'AuthCustomer.image.max' => 'حجم الصورة كبير جدا',
    'AuthCustomer.email.max' => 'لبريد الالكتروني اكبر من اللازم',
    'AuthCustomer.info' => 'تم ارجاع معلومات الزبون',
    'AuthCustomer.email.taken' => 'هذا البريد مستخدم بالفعل',
    'AuthCustomer.email.taken.not' => 'لم يتم استخدام هذا البريد الالكتروني بعد',
    'AuthCustomer.found' => 'هذا الزبون غير موجود',
    'AuthCustomer.all' => 'تم اعادة جميع الزبائن المسجلين بنجاح',
    'AuthCustomer.one' => 'تم اعادة الزبون المطلوب بنجاح',
    'AuthCustomer.create' => 'تم تسجيل الزبون بنجاح',
    'AuthCustomer.update' => 'تم تعديل بيانات الزبون بنجاح',
    'AuthCustomer.deleted' => 'تم حذف الزبون نهائيا بنجاح',


    //===========================================================
    // AUTH Dashboard
    //===========================================================
    'AuthDashboard.email.required' => 'البريد الالكتروني مطلوب',
    'AuthDashboard.email.exists' => 'البريد الالكتروني خاطئ',
    'AuthDashboard.email.email' => 'الرجائ ادخال بريد الكتروني صالح',
    'AuthDashboard.password.required' => 'كلمة المرور مطلوبة',
    'AuthDashboard.password.string' => 'يجب ان تكون كلمة المرور عبارة عن حروف او ارقام او رموز',
    'AuthDashboard.password.min' => 'يجب ان تكون كلمة السر 6 خانات على الاقل',
    'AuthDashboard.name.required' => 'الاسم مطلوب',
    'AuthDashboard.name.string' => 'يجب ان يكون الاسم عبارة عن نص',
    'AuthDashboard.name.max' => 'الاسم اطول من اللازم',
    'AuthDashboard.email.unique' => 'هذا البريد مستخدم بالفعل',
    'AuthDashboard.password.max' => 'يجب ان تكون كلمة المرور 32 خانة على الاكثر',


    //===========================================================
    // CATEGORY
    //===========================================================
    'category.name.required' => 'اسم القسم مطلوب',
    'category.name.string' => 'يجب ان يكون اسم القسم عبارة عن نص',
    'category.name.max' => 'اسم القسم اكبر من اللازم',
    'category.name.unique' => 'اسم القسم مستخدم بالفعل',
    'category.image.required' => 'صورة القسم مطلوبة',
    'category.image.mimes' => 'امتداد الصورة يجب ان يكون: jpeg, png, jpg, gif, svg',
    'category.image.max' => 'حجم الصورة كبير جدا',
    'category.all' => 'تم اعادة جميع الاقسام بنجاح',
    'category.one' => 'تم اعادة القسم المطلوب بنجاح',
    'category.found' => 'القسم المطلوب غير موجود',
    'category.create' => 'تم انشاء القسم بنجاح',
    'category.update' => 'تم تعديل بيانات القسم بنجاح',
    'category.deleted' => 'تم حذف القسم بنجاح',


    //===========================================================
    // CART ITEM
    //===========================================================
    'cartItem.product_id.required' => 'معرف المنتج مطلوب',
    'cartItem.product_id.numeric' => 'يجب ان يكون معرف المنتج عبارة عن رقم',
    'cartItem.product_id.exists' => 'معرف القسم غير صحيح',
    'cartItem.color_id.required' => 'معرف اللون مطلوب',
    'cartItem.color_id.numeric' => 'يجب ان يكون معرف اللون عبارة عن رقم',
    'cartItem.color_id.exists' => 'معرف اللون غير صحيح',
    'cartItem.size_id.numeric' => 'يجب ان يكون معرف الحجم عبارة عن رقم',
    'cartItem.size_id.exists' => 'معرف الحجم غير صحيح',
    'cartItem.quantity.required' => 'الكمية مطلوبة',
    'cartItem.quantity.numeric' => 'يجب ان تكون الكمية عبارة عن رقم',
    'cartItem.quantity.min' => 'يجب ان تكون الكمية عنصر واحد على الاقل',
    'cartItem.quantity.max' => 'هذه الكمية غير متوفرة حاليا',
    'cartItem.address_id.required' => 'معرف العنوان مطلوب',
    'cartItem.address_id.numeric' => 'يجب ان يكون معرف العنوان عبارة عن رقم',
    'cartItem.address_id.exists' => 'معرف العنوان غير صحيح',
    'cartItem.shippingType_id.required' => 'معرف طريقة الشحن مطلوب',
    'cartItem.shippingType_id.numeric' => 'يجب ان يكون معرف طريقة الشحن عبارة عن رقم',
    'cartItem.shippingType_id.exists' => 'معرف طريقة الشحن غير صحيح',
    'cartItem.all' => 'تم اعادة جميع العناصر بداخل العربة',
    'cartItem.one' => 'تم اعادة العنصر المطلوب بنجاح',
    'cartItem.found' => 'العنصر المطلوب غير موجود',
    'cartItem.create' => 'تم اضافة العنصر الى العربة بنجاح',
    'cartItem.update' => 'تم تعديل العنصر الموجود في العربة بنجاح',
    'cartItem.deleted' => 'تم ازالة العنصر من العربة بنجاح',


    //===========================================================
    // ADDRESS
    //===========================================================
    'address.title.required' => 'العنوان مطلوب',
    'address.title.string' => 'يجب ان يكون العنوان عبارة عن نص',
    'address.title.max' => 'العنوان اطول من اللازم',
    'address.title.min' => 'يجب ان يكون العنوان حرف واحد على الاقل',
    'address.address.required' => 'الموقع مطلوب',
    'address.address.string' => 'يجب ان يكون العنوان نص',
    'address.address.max' => 'العنوان اطول من اللازم',
    'address.default.numeric' => 'Default يجب ان يكون 0 او 1',
    'address.default.between' => 'Default يجب ان يكون 0 او 1',
    'address.address.min' => 'يجب ان يكون العنوان حرف واحد على الافل',
    'address.address_id.required' => 'معرف العنوان مطلوب',
    'address.address_id.numeric' => 'يجب ان يكون معرف العنوان عبارة عن رقم',
    'address.address_id.exists' => 'معرف العنوان غير صحيح',
    'address.all' => 'تم اعادة جميع العناوين بنجاح',
    'address.customer.all' => 'تم اعادة جميع عناوين الزبون بنجاح',
    'address.one' => 'تم اعادة العنوان بنجاح',
    'address.found' => 'العنوان المطلوب غير موجود',
    'address.create' => 'تم انشاء العنوان بنجاح',
    'address.update' => 'تم تعديل بيانات العنوان بنجاح',
    'address.deleted' => 'تم حذف العنوان بنجاح',
    'address.default.set' => 'تم وضع العنوان المختار كافتراضي',
    'address.default.get' => 'تم اعادة العنوان الافتراضي بنجاح',
    'address.default.get,failed' => 'لا يوجد اي عنوان افتراضي',


    //===========================================================
    // COLOR
    //===========================================================
    'color.product_id.required' => 'معرف المنتج مطلوب',
    'color.product_id.numeric' => 'يجب ان يكون معرف المنتج عبارة عن رقم',
    'color.product_id.exists' => 'معرف المنتج غير صحيح',
    'color.color.required' => 'اللون مطلوب',
    'color.color.min' => 'يجب ان يكون اللون 3 حروف على الاقل',
    'color.color.max' => 'يجب ان يكون اللون 6 حروف على الاكثر',
    'color.all' => 'تم اعادة جميع الالوان بنجاح',
    'color.one' => 'تم اعادة اللون المطلوب بنجاح',
    'color.found' => 'اللون المطلوب غير موجود',
    'color.create' => 'تم اضافة اللون بنجاح',
    'color.update' => 'تم تحديث بيانات اللون بنجاح',
    'color.deleted' => 'تم حذف اللون بنجاح',


    //===========================================================
    // SIZE
    //===========================================================
    'size.product_id.required' => 'معرف المنتج مطلوب',
    'size.product_id.numeric' => 'يجب ان يكون معرف المنتج عبارة عن رقم',
    'size.product_id.exists' => 'معرف المنتج غير صحيح',
    'size.size.required' => 'الحجم مطلوب',
    'color.size.max' => 'الحجم اكبر م الازم',
    'size.all' => 'تم اعادة جميع الاحجام الموجودة بنجاح',
    'size.one' => 'نم اعادة الحجم المطلوب بنجاح',
    'size.found' => 'الحجم المطلوب غير موجود',
    'size.create' => 'تم اضافة الحجم بنجاح',
    'size.update' => 'تم تعديل بيانات الحجم بنجاح',
    'size.deleted' => 'تم حذف الحجم بنجاح',


    //===========================================================
    // FORGET PASSWORD
    //===========================================================
    'forgetPassword.email.required' => 'البريد الالكتروني مطلوب',
    'forgetPassword.email.email' => 'الرجاء ادخال بريد الكتروني صحيح',
    'forgetPassword.email.exists' => 'الرجاء ادخال بريد الكتروني صحيح',
    'forgetPassword.code.required' => 'الرمز مطلوب',
    'forgetPassword.code.numeric' => 'يجب ان يكون الرمز ارقام فقط',
    'forgetPassword.code.exists' => 'الرمز غير صحيح',
    'forgetPassword.code.max' => 'يجب ان يكون الرمز 6 ارقام',
    'forgetPassword.code.min' => 'يجب ان يكون الرمز 6 ارقام',
    'forgetPassword.code.expired' => 'انتهت صلاحية الرمز',
    'forgetPassword.code.valid' => 'الرمز صحيح',
    'forgetPassword.password.required' => 'كلمة المرور الجديدة مطلوبة',
    'forgetPassword.password.string' => 'يجب ان تكون كلمة المرور عبارة عن بعض الحروف او الارقام او الرموز',
    'forgetPassword.password.min' => 'يجب ان تكون كلمة السر 6 خانات على الاقل',
    'forgetPassword.message.sent' => 'تم ارسال الرمز بنجاح, الرجاء تفقد البريد الالكتروني الخاص بك',
    'forgetPassword.password.reset' => 'تم اعادة تعين كلمة المرور بنجاح',


    //===========================================================
    // IMAGE
    //===========================================================
    'image.images.required' => 'الصور مطلوبة',
    'image.images.array' => 'يجب ارسال الصور كمصفوفة',
    'image.images.*.required' => 'الصورة مطلوبة',
    'image.images.*.mimes' => 'امتداد الصورة يجب ان يكون: jpeg, png, jpg, gif, svg',
    'image.images.*.max' => 'حجم الصورة كبير جدا',
    'image.all' => 'تم اعادة جميع الصور بنجاح',
    'image.one' => 'تم اعادة الصورة المطلوبة بنجاح',
    'image.found' => 'الصورة المطلوبة غير متوفرة',
    'image.create' => 'تم اضافة الصورة بنجاح',
    'image.update' => 'تم تعديل بيانات الصورة بنجاح',
    'image.deleted' => 'تم حذف الصورة بنجاح',


    //===========================================================
    // ORDER
    //===========================================================
    'order.product_id.required' => 'معرف المنتج مطلوب',
    'order.product_id.numeric' => 'يجب ان يكون معرف المنتج عبارة عن رقم',
    'order.product_id.exists' => 'معرف المنتج غير صحيح',
    'order.color_id.required' => 'معرف اللون غير صحيح',
    'order.color_id.numeric' => 'يجب ان يكون معرف اللون عبارة عن رقم',
    'order.color_id.exists' => 'معرف اللون غير صحيح',
    'order.size_id.numeric' => 'يجب ان يكون معرف الحجم عبارة عن رقم',
    'order.size_id.exists' => 'معرف الحجم غير صحيح',
    'order.address_id.required' => 'معرف العنوان مطلوب',
    'order.address_id.numeric' => 'يجب ان يكون معرف العنوان عبارة عن رقم',
    'order.address_id.exists' => 'معرف العنوان غير صحيح',
    'order.shippingType_id.required' => 'معرف طريقة الشحن مطلوب',
    'order.shippingType_id.numeric' => 'يجب ان يكون معرف طريقة الشحن عبارة عن رقم',
    'order.shippingType_id.exists' => 'معرف طريقة الشحن غير صحيح',
    'order.quantity.required' => 'الكمية مطلوبة',
    'order.quantity.numeric' => 'يجب ان تكون الكمية عبارة عن رقم',
    'order.quantity.min' => 'يجب ان يتم اختيار كمية لا تقل عن 1',
    'order.quantity.max' => 'هذه الكمية غير متوفرة حاليا',
    'order.order_id.required' => 'معرف الطلب مطلوب',
    'order.order_id.numeric' => 'يجب ان يكون معرف الطلب عبارة عن رقم',
    'order.order_id.exists' => 'معرف الطلب غير صحيح',
    'order.accept.required' => 'القبول مطلوب',
    'order.accept.boolean' => 'يجب ان يكون القبول اما صح او خطا',
    'order.all' => 'تم اعادة جميع الطلبات بنجاح',
    'order.one' => 'تم اعادة الطلب المطلوب بنجاح',
    'order.found' => 'الطلب المطلوب غير موجود',
    'order.create' => 'تم انشاء الطلب بنجاح',
    'order.update' => 'تم تعديل بيانات الطلب بنجاح',
    'order.deleted' => 'تم حذف الطلب بنجاح',
    'order.shipping' => 'هذا الطلب في مرحلة الشحن بالفعل',
    'order.shipped' => 'تم شحن هذا الطلب بالفعل',
    'order.rejected' => 'هذا الطلب رفض بالفعل',
    'order.transfer.reject' => 'تم رفض الطلب',
    'order.transfer.shipping' => 'تم قبول الطلب وقد تم نقله الى مرحلة الشحن',


    //===========================================================
    // PRODUCT
    //===========================================================
    'product.name.required' => 'اسم المنتج مطلوب',
    'product.name.string' => 'يجب ان يكون اسم المنتج عبارة عن نص',
    'product.name.min' => 'يجب الا يقل اسم المنتج عن حرف',
    'product.name.unique' => 'هذا المنتج موجود بالفعل',
    'product.category_id.required' => 'معرف القسم مطلوب لمعرفة هل المنتج موجود به ام لا',
    'product.category_id.numeric' => 'يجب ان يكون معرف القسم عبارة عن رقم',
    'product.category_id.exists' => 'هذا القسم غير موجود',
    'product.price.required' => 'سعر المنتج مطلوب',
    'product.price.numeric' => 'يجب ان يكون سعر المنتج عبارة عن رقم فقط',
    'product.price.min' => 'يجب ان يكون سعر المنتج 1$ على الاقل',
    'product.quantity.required' => 'الكمية مطلوبة',
    'product.quantity.numeric' => 'يجب ان تكون الكمية عبارة عن رقم',
    'product.quantity.min' => 'يجب ان تكون الكمية 0 على الاقل',
    'product.description.required' => 'الوصف مطلوب',
    'product.description.string' => 'يجب ان يكون الوصف عبارة عن نصف',
    'product.description.min' => 'يجب ان يكون الوصف على الاقل 10 حروف',
    'product.images.required' => 'الصور للمنتج مطلوبة',
    'product.images.array' => 'يجب ان تكون الصور عبارة عن مصفوفة',
    'product.images.*.required' => 'الصورة مطلوبة',
    'product.images.*.mimes' => 'يجب ان تكون امتداد الصورة: jpeg, png, jpg, gif or svg',
    'product.images.*.max' => 'حجم الصورة كبير جدا',
    'product.colors.required' => 'الالوان مطلوبة',
    'product.colors.array' => 'يجب ان تكون الالوان مصفوفة',
    'product.sizes.array' => 'يجب ان تكون الاحجام مصفوفة',
    'product.sizes.*.min' => 'يجب ان يكون الحجم خانة واحدة على الاقل',
    'product.sizes.*.max' => 'الحجم كبير جدا',
    'product.toSearch.required' => 'رجاء املئ حقل البحث',
    'product.toSearch.max' => 'رجاء ادخل اقل من 255 حرف في خانة البحث',
    'product.toSearch.string' => 'يجب ان تبحث عن المنتج من خلال اسمه',
    'product.all' => 'تم اعاد جميع المنتجات بنجاح',
    'product.one' => 'تم اعادة المنتج بنجاح',
    'product.found' => 'المنتج غير موجود',
    'product.create' => 'تم اضافة المنتج بنجاح',
    'product.update' => 'تم تعديل بيانات المنتج بنجاح',
    'product.deleted' => 'تم حذف المنتج بنجاح',

    //===========================================================
    // PRODUCT LIKE
    //===========================================================
    'like.all' => 'جميع المنتجات التي اعجب بها الزبائن',
    'like.customer.product' => 'المنتجات التي اعجبتك',
    'like.true' => 'الزبون اعجب بهذا المنتج',
    'like.false' => 'الزبون لم يبدي اعجابه بالمنتج',
    'like.create' => 'تم الاعجاب بالمنتج بنجاح',
    'like.deleted' => 'تم ازالة الاعجاب',


    //===========================================================
    // SHIPPING TYPE
    //===========================================================
    'shippingType.title.required' => 'العنوان مطلوب',
    'shippingType.title.string' => 'العنوان يجب ان يكون نص',
    'shippingType.title.min' => 'العنوان يجب ان يتكون من حرف واحد على الاقل',
    'shippingType.title.max' => 'العنوان طويل جدا',
    'shippingType.price.required' => 'السعر مطلوب',
    'shippingType.price.numeric' => 'يجب ان يكون السعر عبارة عن رقم',
    'shippingType.price.min' => 'يجب ان يكون السعر 1$ على الاقل',
    'shippingType.minNumberDaysToArrival.required' => 'اقل عدد ايام لتوصيل المنتج مطلوب',
    'shippingType.minNumberDaysToArrival.numeric' => 'اقل عدد ايام لتوصيل المنتج يجب ان يكون رقم',
    'shippingType.minNumberDaysToArrival.min' => 'اقل عدد ايام لتوصيل المنتج مطلوب ان يكون يوم واحد على الاقل',
    'shippingType.minNumberDaysToArrival.max' => 'اقل عدد ايام لتوصيل المنتج يجب ان يكون اقل من اعلى عدد ايام لتوصيل المنتج',
    'shippingType.maxNumberDaysToArrival.required' => 'اعلى عدد ايام لتوصيل المنتج مطلوب',
    'shippingType.maxNumberDaysToArrival.numeric' => 'اعلى عدد ايام لتوصيل المنتج يجب ان يكون رقم',
    'shippingType.maxNumberDaysToArrival.min' => 'اعلى عدد ايام لتوصيل المنتج يجب ان يكون اعلى من اقل عدد ايام لتوصيل المنتج',
    'shippingType.all' => 'تم اعادة جميع طرق الشحن المتوفرة',
    'shippingType.one' => 'تم اعادة طريقة الشحن بنجاح',
    'shippingType.found' => 'طريقة الشحن غير موجودة',
    'shippingType.create' => 'تم اضافة طريقة الشحن بنجاح',
    'shippingType.update' => 'تم تحديث بيانات طريقة الشحن بنجاح',
    'shippingType.deleted' => 'تم حذف طريقة الشحن بنجاح',
];
