<?php

namespace Database\Seeders;

use App\Models\FrontendKey;
use App\Models\KeysTranslate;
use App\Models\Language;
use Illuminate\Database\Seeder;

class FrontendKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tarjima kalitlari
        $keys = [
            'home' => ['uz' => 'Bosh sahifa', 'ru' => 'Главная', 'en' => 'Home'],
            'about' => ['uz' => 'Biz haqimizda', 'ru' => 'О нас', 'en' => 'About'],
            'contact' => ['uz' => 'Aloqa', 'ru' => 'Контакты', 'en' => 'Contact'],
            'presidium' => ['uz' => 'Prezidium', 'ru' => 'Президиум', 'en' => 'Presidium'],
            'news' => ['uz' => 'Yangiliklar', 'ru' => 'Новости', 'en' => 'News'],
            'conferences' => ['uz' => 'Konferensiyalar', 'ru' => 'Конференции', 'en' => 'Conferences'],
            'books' => ['uz' => 'Kitoblar', 'ru' => 'Книги', 'en' => 'Books'],
            'projects' => ['uz' => 'Loyihalar', 'ru' => 'Проекты', 'en' => 'Projects'],

            'categories' => ['uz' => 'Bo\'limlar', 'ru' => 'Категории', 'en' => 'Categories'],
            'no_categories'=> ['uz'=> 'Bo‘limlar yo‘q', 'ru' => 'Нет категорий', 'en'=> 'No categories'],
            'create_first_category'=> ['uz'=> 'Birinchi bo‘limni yaratish', 'ru' => 'Создать первую категорию', 'en'=> 'Create first category'],
            'create_new_category' => ['uz'=> 'Yangi bo‘lim yaratish', 'ru' => 'Создать новую категорию', 'en'=> 'Create new category'],
            'parent_category' => ['uz' => 'Asosiy bo\'lim', 'ru' => 'Родительская категория', 'en' => 'Parent category'],
            'no_parent' => ['uz' => 'Bo\'limsiz', 'ru' => 'Без родителя', 'en' => 'No parent'],
            'is_active' => ['uz' => 'Faol holati', 'ru' => 'Активность', 'en' => 'Active status'],
            'active' => ['uz' => 'Faol', 'ru' => 'Активный', 'en' => 'Active'],
            'inactive' => ['uz' => 'Faol emas', 'ru' => 'Неактивный', 'en' => 'Inactive'],
            'description' => ['uz' => 'Tavsif', 'ru' => 'Описание', 'en' => 'Description'],
            'category_translates' => ['uz'=> 'Bo\'lim tarjimalari', 'ru' => 'Переводы раздела', 'en'=> 'Category translates'],
            'form_edit_category' => ['uz'=> 'Bo‘limni tahrirlash', 'ru' => 'Изменить раздел', 'en'=> 'Edit section'],
            'no_translation_available' => ['uz'=> 'Tarjima mavjud emas', 'ru' => 'Перевод недоступен', 'en'=> 'No translation available'],

            'error_translation_required' => ['uz'=> 'Hech bo\'lmaganda bitta kategoriya tarjimasi kiritilishi kerak.', 'ru' => 'Необходимо добавить перевод как минимум одной категории.', 'en'=> 'At least one category translation must be entered.'],
            'category_created_successfully' => ['uz'=> 'Bo\'lim muvaffaqiyatli yaratildi', 'ru' => 'Категория успешно создана', 'en'=> 'Category created successfully'],
            'category_updated_successfully' => ['uz'=> 'Bo\'lim muvaffaqiyatli yangilandi', 'ru' => 'Категория успешно обновлена', 'en'=> 'Category updated successfully'],
            'category_deleted_successfully'=> ['uz'=> 'Bo\'lim muvaffaqiyatli o\'chirildi', 'ru' => 'Категория успешно удалена', 'en'=> 'Category deleted successfully'],
            'slug_exists' => ['uz' => 'Slug allaqachon mavjud', 'ru' => 'Этот слаг уже существует', 'en' => 'The slug already exists'],
            'slug_exists_for_language' => ['uz' => 'til uchun. Iltimos, boshqa slug kiriting.', 'ru' => 'для этого языка. Пожалуйста, введите другой слаг.', 'en' => 'for this language. Please choose a different slug.'],


            'dashboard' => ['uz' => 'Boshqaruv paneli', 'ru' => 'Панель управления', 'en' => 'Dashboard'],
            'roles' => ['uz' => 'Rollar', 'ru' => 'Роли', 'en' => 'Roles'],
            'permissions' => ['uz' => 'Ruxsatnomalar', 'ru' => 'Разрешения', 'en' => 'Permissions'],

            'users' => ['uz' => 'Foydalanuvchilar', 'ru' => 'Пользователи', 'en' => 'Users'],
            'users_list' => ['uz' => 'Foydalanuvchilar ro\'yhati', 'ru' => 'Список пользователей', 'en' => 'Users list'],
            'tgusers' => ['uz' => 'TG foydalanuvchilari', 'ru' => 'Пользователи TG', 'en' => 'TG users'],
            'search_results' => ['uz' => 'Qidiruv natijalari', 'ru' => 'Результаты поиска', 'en' => 'Search results'],
            'no_results' => ['uz' => 'Natija topilmadi', 'ru' => 'Результат не найден', 'en' => 'No results'],
            'create_first_user' => ['uz' => 'Birinchi foydalanuvchini yaratish', 'ru' => 'Создать первого пользователя', 'en' => 'Create first user'],
            'tgusers_list' => ['uz' => 'TG foydalanuvchilari ro\'yhati', 'ru' => 'Список пользователей TG', 'en' => 'TG users list'],
            'tguser_id' => ['uz' => 'TG foydalanuvchi ID', 'ru' => 'ID пользователя TG', 'en' => 'TG user ID'],
            'tguser_phone_number' => ['uz' => 'TG foydalanuvchi telefon raqami', 'ru' => 'Телефонный номер пользователя TG', 'en' => 'TG user phone number'],
            'additional_data' => ['uz' => 'Qo\'shimcha ma\'lumotlar', 'ru' => 'Дополнительные данные', 'en' => 'Additional data'],
            'import_tgusers' => ['uz' => 'TG foydalanuvchilarini import qilish', 'ru' => 'Импорт пользователей TG', 'en' => 'Import TG users'],
            'no_tgusers' => ['uz' => 'TG foydalanuvchilari yo\'q', 'ru' => 'Нет пользователей TG', 'en' => 'No TG users'],
            'create_first_tguser' => ['uz' => 'Birinchi TG foydalanuvchini yaratish', 'ru' => 'Создать первого пользователя TG', 'en' => 'Create first TG user'],
            'profile' => ['uz' => 'Profil', 'ru' => 'Профиль', 'en' => 'Profile'],
            'edit_profile' => ['uz' => 'Profilni tahrirlash', 'ru' => 'Редактировать профиль', 'en' => 'Edit profile'],
            'update_profile' => ['uz' => 'Profilni yangilash', 'ru' => 'Обновить профиль', 'en' => 'Update profile'],
            'users_management' => ['uz' => 'Foydalanuvchilar boshqaruvini', 'ru' => 'Управление пользователями', 'en' => 'Users management'],
            'user' => ['uz' => 'Foydalanuvchi', 'ru' => 'Пользователь', 'en' => 'User'],
            'user_created_successfully' => ['uz' => 'Foydalanuvchi muvaffaqiyatli yaratildi', 'ru' => 'Пользователь успешно создан', 'en' => 'User created successfully'],
            'user_updated_successfully' => ['uz' => 'Foydalanuvchi muvaffaqiyatli yangilandi', 'ru' => 'Пользователь успешно обновлен', 'en' => 'User updated successfully'],
            'user_deleted_successfully' => ['uz' => 'Foydalanuvchi muvaffaqiyatli o\'chirildi', 'ru' => 'Пользователь успешно удален', 'en' => 'User deleted successfully'],

            'languages' => ['uz' => 'Tillar', 'ru' => 'Языки', 'en' => 'Languages'],
            'keys_translate' => ['uz' => 'Kalit so\'zlarni tarjima qilish', 'ru' => 'Перевод ключевых слов', 'en' => 'Translate keys'],
            'keys' => ['uz' => 'Kalit so\'zlar', 'ru' => 'Ключевых слов', 'en' => 'Keys words'],
            'login' => ['uz' => 'Kirish', 'ru' => 'Войти', 'en' => 'Login'],
            'register' => ['uz' => 'Ro\'yxatdan o\'tish', 'ru' => 'Регистрация', 'en' => 'Register'],
            'logout' => ['uz' => 'Chiqish', 'ru' => 'Выйти', 'en' => 'Logout'],
            'email' => ['uz' => 'Elektron pochta', 'ru' => 'Электронная почта', 'en' => 'Email'],
            'full_name' => ['uz' => 'To\'liq ism', 'ru' => 'Полное имя', 'en' => 'Full name'],
            'password' => ['uz' => 'Parol', 'ru' => 'Пароль', 'en' => 'Password'],
            'current_password' => ['uz' => 'Hozirgi parol', 'ru' => 'Текущий пароль', 'en' => 'Current password'],
            'new_password' => ['uz' => 'Yangi parol', 'ru' => 'Новый пароль', 'en' => 'New password'],
            'confirm_password' => ['uz' => 'Parolni tasdiqlash', 'ru' => 'Подтвердите пароль', 'en' => 'Confirm password'],
            'confirm_new_password' => ['uz' => 'Yangi parolni tasdiqlash', 'ru' => 'Подтвердите новый пароль', 'en' => 'Confirm new password'],
            'remember_me' => ['uz' => 'Meni eslab qol', 'ru' => 'Запомнить меня', 'en' => 'Remember me'],
            'leave_blank_to_keep_current_password' => ['uz' => 'Hozirgi parolni saqlash uchun bo\'sh qoldiring', 'ru' => 'Оставьте пустым, чтобы сохранить текущий пароль', 'en' => 'Leave blank to keep current password'],
            'forgot_your_password' => ['uz' => 'Parolingizni unutdingizmi?', 'ru' => 'Забыли пароль?', 'en' => 'Forgot your password?'],
            'authentification' => ['uz' => 'Autentifikatsiya', 'ru' => 'Аутентификация', 'en' => 'Authentication'],
            'menu' => ['uz' => 'Menyu', 'ru' => 'Меню', 'en' => 'Menu'],

            'actions' => ['uz' => 'Harakatlar', 'ru' => 'Действия', 'en' => 'Actions'],
            'create' => ['uz' => 'Yaratish', 'ru' => 'Создать', 'en' => 'Create'],
            'form_edit_user' => ['uz' => 'Foydalanuvchini tahrirlash', 'ru' => 'Редактировать пользователя', 'en' => 'Edit user'],
            'choose_file' => ['uz' => 'Faylni tanlash', 'ru' => 'Выберите файл', 'en' => 'Choose file'],
            'paste_text_data' => ['uz' => 'Matn ma\'lumotlarini qo\'shish', 'ru' => 'Вставьте текстовые данные', 'en' => 'Paste text data'],
            'import_file' => ['uz' => 'Faylni import qilish', 'ru' => 'Импорт файла', 'en' => 'Import file'],
            'import_text' => ['uz' => 'Matn import qilish', 'ru' => 'Импорт текста', 'en' => 'Import text'],
            'import' => ['uz' => 'Import', 'ru' => 'Импорт', 'en' => 'Import'],
            'export' => ['uz' => 'Eksport', 'ru' => 'Экспорт', 'en' => 'Export'],
            'you_searched_for' => ['uz' => 'Siz qidirdingiz', 'ru' => 'Вы искали', 'en' => 'You searched for'],
            'no_input_given' => ['uz' => 'Kiritilgan ma\'lumotlar yo\'q', 'ru' => 'Нет введенных данных', 'en' => 'No input given'],
            'no_input_given_for_search' => ['uz' => 'Qidirish uchun kiritilgan ma\'lumotlar yo\'q', 'ru' => 'Нет введенных данных для поиска', 'en' => 'No input given for search'],
            'create_new_user' => ['uz' => 'Yangi foydalanuvchi yaratish', 'ru' => 'Создать нового пользователя', 'en' => 'Create new user'],
            'edit_user' => ['uz' => 'Foydalanuvchini tahrirlash', 'ru' => 'Редактировать пользователя', 'en' => 'Edit user'],


            'form_create_new' => ['uz' => 'Yangi yaratish', 'ru' => 'Создать новый', 'en' => 'Create new'],
            'add_translation' => ['uz' => 'Tarjima kiritish', 'ru'=> 'Добавить перевод', 'en'=> 'Add translation'],
            'form_edit' => ['uz' => 'Tahrirlash', 'ru' => 'Редактировать', 'en' => 'Edit'],

            'edit' => ['uz' => 'Tahrirlash', 'ru' => 'Редактировать', 'en' => 'Edit'],
            'delete' => ['uz' => 'O\'chirish', 'ru' => 'Удалить', 'en' => 'Delete'],
            'confirm_delete'=> ['uz'=> 'O‘chirishni tasdiqlash', 'ru' => 'Подтвердите удаление', 'en'=> 'Confirm delete'],
            'delete_confirmation_message' => ['uz'=> 'Siz rostdanham o\'chirimoqchimisiz?', 'ru' => 'Вы действительно хотите удалить?', 'en'=> 'Are you sure you want to delete?'],

            'update' => ['uz' => 'Yangilash', 'ru' => 'Обновить', 'en' => 'Update'],
            'add' => ['uz' => 'Qo\'shish', 'ru' => '', 'en' => 'Add'],
            'save' => ['uz' => 'Saqlash', 'ru' => 'Сохранить', 'en' => 'Save'],
            'cancel' => ['uz' => 'Bekor qilish', 'ru' => 'Отмена', 'en' => 'Cancel'],
            'reset' => ['uz' => 'Qayta o\'rnatish', 'ru' => 'Сброс', 'en' => 'Reset'],
            'close' => ['uz' => 'Yopish', 'ru' => 'Закрыть', 'en' => 'Close'],
            'back_to_list' => ['uz' => 'Ro\'yhatga qaytish', 'ru' => 'Вернуться к списку', 'en' => 'Back to list'],
            'back' => ['uz' => 'Orqaga', 'ru' => 'Назад', 'en' => 'Back'],
            'search' => ['uz' => 'Qidirish', 'ru' => 'Поиск', 'en' => 'Search'],
            'show' => ['uz' => 'Ko\'rsatish', 'ru' => 'Показать', 'en' => 'Show'],
            'views' => ['uz' => 'Ko\'rishlar', 'ru' => 'Просмотры', 'en' => 'Views'],
            'view' => ['uz' => 'Ko\'rish', 'ru' => 'Просмотр', 'en' => 'View'],
            'download' => ['uz' => 'Yuklab olish', 'ru' => 'Скачать', 'en' => 'Download'],
            'upload' => ['uz' => 'Yuklash', 'ru' => 'Загрузить', 'en' => 'Upload'],
            'import_data' => ['uz' => 'Ma\'lumotlarni import qilish', 'ru' => 'Импорт данных', 'en' => 'Import data'],
            'export_data' => ['uz' => 'Ma\'lumotlarni eksport qilish', 'ru' => 'Экспорт данных', 'en' => 'Export data'],
            'no_data' => ['uz' => 'Ma\'lumotlar yo\'q', 'ru' => 'Нет данных', 'en' => 'No data'],
            'no_data_available' => ['uz' => 'Ma\'lumotlar mavjud emas', 'ru' => 'Данные отсутствуют', 'en' => 'No data available'],
            'no_data_found' => ['uz' => 'Ma\'lumotlar topilmadi', 'ru' => 'Данные не найдены', 'en' => 'No data found'],
            'no_results_found' => ['uz' => 'Natija topilmadi', 'ru' => 'Результат не найден', 'en' => 'No results found'],
            'no_data_to_display' => ['uz' => 'Ko\'rsatish uchun ma\'lumotlar yo\'q', 'ru' => 'Нет данных для отображения', 'en' => 'No data to display'],
            'count' => ['uz' => 'Soni', 'ru' => 'Количество', 'en' => 'Count'],

            'created_successfully' => ['uz' => 'Muvaffaqiyatli yaratildi', 'ru' => 'Успешно создан', 'en' => 'Created successfully'],
            'updated_successfully' => ['uz' => 'Muvaffaqiyatli yangilandi', 'ru' => 'Успешно обновлен', 'en' => 'Updated successfully'],
            'deleted_successfully' => ['uz' => 'Muvaffaqiyatli o\'chirildi', 'ru' => 'Успешно удален', 'en' => 'Deleted successfully'],

            'Yes' => ['uz' => 'Ha', 'ru' => 'Да', 'en' => 'Yes'],
            'No' => ['uz' => 'Yo\'q', 'ru' => 'Нет', 'en' => 'No'],

            'generate_permission' => ['uz' => 'Ruxsatnomalarni yaratish', 'ru' => 'Генерировать разрешения', 'en' => 'Generate permissions'],
            'resource_name' => ['uz' => 'Resurs nomi', 'ru' => 'Имя ресурса', 'en' => 'Resource name'],
            'code' => ['uz' => 'Kod', 'ru' => 'Код', 'en' => 'Code'],
            'name' => ['uz' => 'Nomi', 'ru' => 'Имя', 'en' => 'Name'],
            'default' => ['uz' => 'Standart', 'ru' => 'По умолчанию', 'en' => 'Default'],
            'flag' => ['uz' => 'Bayroq', 'ru' => 'Флаг', 'en' => 'Flag'],
            'navigation' => ['uz' => 'Navigatsiya', 'ru' => 'Навигация', 'en' => 'Navigation'],
            'settings' => ['uz' => 'Sozlamalar', 'ru' => 'Настройки', 'en' => 'Settings'],
        ];

        // Mavjud tillarni olish
        $languages = Language::whereIn('code', ['uz', 'ru', 'en'])->get()->keyBy('code');

        foreach ($keys as $key => $translations) {
            // Frontend kalitini yaratish
            $frontendKey = FrontendKey::firstOrCreate(['key' => $key]);

            foreach ($translations as $langCode => $value) {
                if (isset($languages[$langCode])) {
                    // Tarjima qo‘shish
                    KeysTranslate::firstOrCreate([
                        'frontend_key_id' => $frontendKey->id,
                        'language_id' => $languages[$langCode]->id,
                        'value' => $value,
                    ]);
                }
            }
        }
    }
}
