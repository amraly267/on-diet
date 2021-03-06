<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة.',
    'attached'             => ':attribute تم إرفاقه بالفعل.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists'               => 'القيمة المحددة :attribute غير موجودة.',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري.',
    'gt'                   => [
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string'  => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
    ],
    'gte'                  => [
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
    ],
    'image'                => 'يجب أن يكون :attribute صورةً.',
    'in'                   => ':attribute غير موجود.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصًا من نوع JSON.',
    'lt'                   => [
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
    ],
    'lte'                  => [
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
    ],
    'max'                  => [
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
    ],
    'multiple_of'          => ':attribute يجب أن يكون من مضاعفات :value',
    'not_in'               => 'العنصر :attribute غير صحيح.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب تقديم :attribute.',
    'prohibited'           => ':attribute محظور.',
    'prohibited_if'        => ':attribute محظور إذا كان :other هو :value.',
    'prohibited_unless'    => ':attribute محظور ما لم يكن :other ضمن :values.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'relatable'            => ':attribute قد لا يكون مرتبطا بالمصدر المحدد.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'             => 'فشل في تحميل الـ :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'                 => ':attribute يجب أن يكون بصيغة UUID سليمة.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes'           => [
        'address'               => 'العنوان',
        'age'                   => 'العمر',
        'available'             => 'مُتاح',
        'city'                  => 'المدينة',
        'content'               => 'المُحتوى',
        'country'               => 'الدولة',
        'date'                  => 'التاريخ',
        'day'                   => 'اليوم',
        'description'           => 'الوصف',
        'email'                 => 'البريد الالكتروني',
        'excerpt'               => 'المُلخص',
        'first_name'            => 'الاسم الأول',
        'gender'                => 'النوع',
        'hour'                  => 'ساعة',
        'last_name'             => 'اسم العائلة',
        'minute'                => 'دقيقة',
        'mobile'                => 'الجوال',
        'month'                 => 'الشهر',
        'name'                  => 'الاسم',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'phone'                 => 'الهاتف',
        'second'                => 'ثانية',
        'sex'                   => 'الجنس',
        'size'                  => 'الحجم',
        'time'                  => 'الوقت',
        'title'                 => 'العنوان',
        'username'              => 'اسم المُستخدم',
        'year'                  => 'السنة',
        "email" => "البريد الإلكتروني",
        "password" => "كلمة المرور",
        "forget_password" => "نسيت كلمة المرور ؟",
        "login" => "تسجيل دخول",
        "invalid_credentials" => "بيانات الدخول غير صحيحة",
        "are_you_sure_logout" => "هل تريد تسجيل خروج ؟",
        "send_reset_password_link" => "ارسال رابط اعادة تعيين كلمة المرور",
        "success_send" => "تم الارسال",
        "confirm_password" => "تأكيد كلمة المرور",
        "success_reset_password" => "تم تغيير كلمة المرور",
        "ok" => "تأكيد",
        "cancel" => "الغاء",
        "save" => "حفظ",
        "confirmation" => "تأكيد",
        "home" => "الرئيسية",
        "admins" => "المسؤولين",
        "search" => "بحث",
        "name" => "الاسم",
        "mobile" => "رقم الجوال",
        "actions" => "العمليات",
        "more_info" => "المزيد",
        "edit" => "تعديل",
        "logout" => "تسجيل خروج",
        "sing_in_dashboard" => "تسجيل دخول للوحة التحكم",
        "enter_email_to_reset_password" => "ادخل بريدك الالكتروني لاستعادة كلمة المرور",
        "reset_password" => "اعادة تعيين كلمة المرور",
        "total_results" => "اجمالي النتائج: :val",
        "image" => "الصورة",
        "no_result" => "لا يوجد نتائج",
        "role" => "الدور",
        "language" => "اللغة",
        "english" => "انجليزي",
        "arabic" => "عربي",
        "add_new" => "اضافة جديد",
        "remove_image" => "حذف الصورة",
        "change_image" => "تغيير الصورة",
        "success_save" => "تم الحفظ",
        "success_delete" => "تم الحذف",
        "edit" => "تعديل",
        "let_password_empty" => "اترك كلمة المرور فارغة اذا لم تريد تعديله",
        "delete_question" => "هل تريد حذف هذا العنصر ؟",
        "cannot_delete_your_account" => "لا يمكن حذف حسابك",
        "my_profile" => "حسابي",
        "roles" => "الأدوار",
        "permissions" => "المسؤوليات",
        "total_admins" => "عدد المسؤولين",
        "total_roles" => "عدد المسؤوليات",
        "total_countries" => "عدد الدول",
        "countries" => "الدول",
        "name_code" => "كود الاسم",
        "phone_code" => "كود الهاتف",
        "status" => "الحالة",
        "flag" => "العلم",
        "active" => "مفعل",
        "deactivate" => "غير مفعل",
        "name_en" => "الاسم (انجليزي)",
        "name_ar" => "الاسم (عربي)",
        "name_is_required" => "الاسم مطلوب.",
        "name_is_already_exist" => "الاسم موجود مسبقا.",
        "static_pages" => "الصفحات الثابتة",
        "title" => "العنوان",
        "title_ar" => "العنوان (عربي)",
        "title_en" => "العنوان (انجليزي)",
        "description_ar" => "الوصف (عربي)",
        "description_en" => "الوصف (انجليزي)",
        "description_is_required" => ".الوصف مطلوب",
        "title_is_required" => ".العنوان مطلوب",
        "settings" => "الاعدادات",
        "project_name_en" => "اسم المشروع (انجليزي)",
        "project_name_ar" => "اسم المشروع (عربي)",
        "contact_us_email" => "البريد الالكتروني للتواصل",
        "contact_us_mobile" => "رقم الاتصال للتواصل",
        "facebook_url" => "رابط الفيسبوك",
        "twitter_url" => "رابط تويتر",
        "youtube_url" => "رابط يوتيوب",
        "instagram_url" => "رابط انستجرام",
        "snapchat_url" => "رابط سناب شات",
        "whatsapp_number" => "رقم الواتساب",
        "logo" => "لوجو",
        "admins_permissions" => "المسؤوليين والصلاحيات",
        "general_settings" => "اعدادات عامة",
        "total_static_pages" => "عدد الصفحات الثابتة",
        "css_in_header" => "Css in header",
        "js_before_header" => "Js before header",
        "js_before_body" => "Js before body",
        "admin" => "المسؤول",
        "country" => "الدولة",
        "page" => "الصفحة الثابتة",
        "setting" => "الاعدادات",
        "statistics" => "الاحصائيات",
        "male" => "ذكر",
        "female" => "أنثى",
        "gender" => "الجنس",
        "country_id" => "الدولة",
        "cities" => "المدن",
        "places" => "الأماكن",
        "areas" => "المناطق",
        "area" => "المنطقة",
        "city" => "المدينة",
        "keyword" => "كلمة البحث",
        "page_length" => "عدد السجلات",
        "print" => "طباعة",
        "pdf" => "PDF",
        "excel" => "Excel",
        "columns" => "الأعمدة",
        "all" => "الكل",
        "reset" => "إعادة تعيين",
        "export" => "تصدير",
        "main_info" => "المعلومات الاساسية",
        'general_settings' => "اعدادات عامة",
        'appearance' => "المظهر",
        'social_media' => "وسائل التواصل",
        'custome_css_js' => "Custom CSS/JS",
        'countries_languages' => "الدول واللغات",
        'supported_countries' => "الدول المدعومة",
        'default_country' => "الدولة الافتراضية",
        'supported_locales' => "اللغات المدعومة",
        'default_locale' => "اللغة الافتراضية",
        'default_timezone' => "التوقيت الافتراضي",
        'normal_logo' => 'الشعار الاساسي',
        'app_icon' => 'ايقونة التطبيق',
        'favicon' => 'الايقونة المفضلة',
        'white_logo' => 'الشعار الابيض',
        'customer_role' => 'دور العميل',
        'contacts_info' => 'معلومات الاتصال',
        'address' => 'العنوان',
        'mail_configuration' => 'اعدادات البريد الالكتروني',
        'mail_from_address' => 'عنوان البريد الالكتروني عند الارسال',
        'mail_from_name' => 'الاسم عند ارسال البريد الالكتروني',
        'mail_host' => 'مضيف البريد الالكتروني',
        'mail_port' => 'منفذ ارسال البريد الالكتروني',
        'mail_username' => 'اسم المستخدم للبريد الالكتروني',
        'mail_password' => 'كلمة المرور للبريد الالكتروني',
        'mail_encryption' => 'تشفير البريد الالكتروني',
        'send_welcome_email' => 'ارسال رسالة الترحيب',
        'invalid_host' => 'المضيف غير صحيح'

    ],
];
