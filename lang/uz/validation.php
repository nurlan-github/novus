<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tasdiqlash (Validation) uchun til qatorlari - uz
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute maydoni qabul qilinishi kerak.',
    'accepted_if' => ':other :value bo‘lsa, :attribute maydoni qabul qilinishi kerak.',
    'active_url' => ':attribute maydoni yaroqli URL bo‘lishi kerak.',
    'after' => ':attribute maydoni :date sanasidan keyin bo‘lishi kerak.',
    'after_or_equal' => ':attribute maydoni :date sanasidan keyin yoki unga teng bo‘lishi kerak.',
    'alpha' => ':attribute faqat harflardan iborat bo‘lishi kerak.',
    'alpha_dash' => ':attribute faqat harflar, raqamlar, chiziqcha va pastki chiziqdan iborat bo‘lishi kerak.',
    'alpha_num' => ':attribute faqat harflar va raqamlardan iborat bo‘lishi kerak.',
    'array' => ':attribute maydoni massiv bo‘lishi kerak.',
    'ascii' => ':attribute faqat bitta baytli alfanumerik belgilar va simvollarni o‘z ichiga olishi mumkin.',
    'before' => ':attribute maydoni :date sanasidan oldin bo‘lishi kerak.',
    'before_or_equal' => ':attribute maydoni :date sanasidan oldin yoki unga teng bo‘lishi kerak.',
    'between' => [
        'array' => ':attribute :min dan :max gacha elementlardan iborat bo‘lishi kerak.',
        'file' => ':attribute hajmi :min dan :max kilobaytgacha bo‘lishi kerak.',
        'numeric' => ':attribute :min va :max orasida bo‘lishi kerak.',
        'string' => ':attribute uzunligi :min dan :max ta belgigacha bo‘lishi kerak.',
    ],
    'boolean' => ':attribute maydoni true yoki false bo‘lishi kerak.',
    'can' => ':attribute maydoni ruxsat etilmagan qiymatni o‘z ichiga oladi.',
    'confirmed' => ':attribute tasdiqlash mos kelmadi.',
    'current_password' => 'Parol noto‘g‘ri.',
    'date' => ':attribute yaroqli sana bo‘lishi kerak.',
    'date_equals' => ':attribute :date sanasiga teng bo‘lishi kerak.',
    'date_format' => ':attribute formati :format bo‘lishi kerak.',
    'decimal' => ':attribute :decimal kasr sonlar bo‘lishi kerak.',
    'declined' => ':attribute rad etilishi kerak.',
    'declined_if' => ':other :value bo‘lsa, :attribute rad etilishi kerak.',
    'different' => ':attribute va :other farqli bo‘lishi kerak.',
    'digits' => ':attribute :digits raqamdan iborat bo‘lishi kerak.',
    'digits_between' => ':attribute :min va :max raqamlar orasida bo‘lishi kerak.',
    'dimensions' => ':attribute rasm o‘lchamlari noto‘g‘ri.',
    'distinct' => ':attribute maydonida takroriy qiymat bor.',
    'doesnt_end_with' => ':attribute quyidagilardan biri bilan tugamasligi kerak: :values.',
    'doesnt_start_with' => ':attribute quyidagilardan biri bilan boshlanmasligi kerak: :values.',
    'email' => ':attribute yaroqli elektron pochta bo‘lishi kerak.',
    'ends_with' => ':attribute quyidagilardan biri bilan tugashi kerak: :values.',
    'enum' => 'Tanlangan :attribute yaroqsiz.',
    'exists' => 'Tanlangan :attribute yaroqsiz.',
    'extensions' => ':attribute quyidagi kengaytmalar bilan bo‘lishi kerak: :values.',
    'file' => ':attribute fayl bo‘lishi kerak.',
    'filled' => ':attribute maydonida qiymat bo‘lishi kerak.',
    'gt' => [
        'array' => ':attribute :value tadan ko‘p elementlarga ega bo‘lishi kerak.',
        'file' => ':attribute hajmi :value kilobaytdan katta bo‘lishi kerak.',
        'numeric' => ':attribute :value dan katta bo‘lishi kerak.',
        'string' => ':attribute :value ta belgidan uzun bo‘lishi kerak.',
    ],
    'gte' => [
        'array' => ':attribute kamida :value elementga ega bo‘lishi kerak.',
        'file' => ':attribute hajmi :value kilobayt yoki undan katta bo‘lishi kerak.',
        'numeric' => ':attribute :value yoki undan katta bo‘lishi kerak.',
        'string' => ':attribute :value ta belgidan kam bo‘lmasligi kerak.',
    ],
    'image' => ':attribute rasm bo‘lishi kerak.',
    'in' => 'Tanlangan :attribute yaroqsiz.',
    'integer' => ':attribute butun son bo‘lishi kerak.',
    'ip' => ':attribute yaroqli IP manzil bo‘lishi kerak.',
    'json' => ':attribute yaroqli JSON qatori bo‘lishi kerak.',
    'lowercase' => ':attribute kichik harflardan iborat bo‘lishi kerak.',
    'lt' => [
        'array' => ':attribute :value tadan kam elementlarga ega bo‘lishi kerak.',
        'file' => ':attribute hajmi :value kilobaytdan kam bo‘lishi kerak.',
        'numeric' => ':attribute :value dan kam bo‘lishi kerak.',
        'string' => ':attribute :value ta belgidan kam bo‘lishi kerak.',
    ],
    'lte' => [
        'array' => ':attribute :value dan ortiq elementga ega bo‘lmasligi kerak.',
        'file' => ':attribute hajmi :value kilobaytdan oshmasligi kerak.',
        'numeric' => ':attribute :value yoki undan kam bo‘lishi kerak.',
        'string' => ':attribute :value ta belgidan oshmasligi kerak.',
    ],
    'max' => [
        'array' => ':attribute :max tadan ortiq bo‘lishi mumkin emas.',
        'file' => ':attribute hajmi :max kilobaytdan oshmasligi kerak.',
        'numeric' => ':attribute :max dan oshmasligi kerak.',
        'string' => ':attribute uzunligi :max ta belgidan oshmasligi kerak.',
    ],
    'min' => [
        'array' => ':attribute kamida :min elementga ega bo‘lishi kerak.',
        'file' => ':attribute hajmi kamida :min kilobayt bo‘lishi kerak.',
        'numeric' => ':attribute kamida :min bo‘lishi kerak.',
        'string' => ':attribute kamida :min ta belgidan iborat bo‘lishi kerak.',
    ],
    'not_in' => 'Tanlangan :attribute yaroqsiz.',
    'numeric' => ':attribute raqam bo‘lishi kerak.',
    'password' => [
        'letters' => ':attribute kamida bitta harfni o‘z ichiga olishi kerak.',
        'numbers' => ':attribute kamida bitta raqamni o‘z ichiga olishi kerak.',
        'symbols' => ':attribute kamida bitta maxsus belgi o‘z ichiga olishi kerak.',
    ],
    'required' => ':attribute maydoni to‘ldirilishi shart.',
    'same' => ':attribute va :other mos kelishi kerak.',
    'string' => ':attribute qator bo‘lishi kerak.',
    'unique' => ':attribute allaqachon olingan.',
    'url' => ':attribute yaroqli URL bo‘lishi kerak.',
    
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'maxsus-xabar',
        ],
    ],

    'attributes' => [],

];
