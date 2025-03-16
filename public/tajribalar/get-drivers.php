<?php

// API so'rov uchun kerakli ma'lumotlar
$url = "https://north.uz.taxi/management/fleet/drivers/get-drivers";
$login = "ernazar";
$password = "5771199erator";
$cookie = "XSRF-TOKEN=eyJpdiI6Ijd3dzhCK1lob1R5eGpkNzBOVDZSeFE9PSIsInZhbHVlIjoiT2tod3duYVFXUVM0UnMyYzFkY1pVaVB5WSt4NDlTajBOc1wvNFNsOHptWEQ2THpcL0RwWUtVekVkNmcyN2QwMlJyMHlncEI1RVRzZHNUNjdmOVhZb3poUT09IiwibWFjIjoiZWU5OWRjOGM5YzIyYjNiMjk5NDg2NzJiNjM3YTRhODVjZGIyMmU2OTg3ZWZlMTMyMTcyMWUxNTQ3MTgzMDc2MyJ9";
$x_xsrf_token = "eyJpdiI6Ijd3dzhCK1lob1R5eGpkNzBOVDZSeFE9PSIsInZhbHVlIjoiT2tod3duYVFXUVM0UnMyYzFkY1pVaVB5WSt4NDlTajBOc1wvNFNsOHptWEQ2THpcL0RwWUtVekVkNmcyN2QwMlJyMHlncEI1RVRzZHNUNjdmOVhZb3poUT09IiwibWFjIjoiZWU5OWRjOGM5YzIyYjNiMjk5NDg2NzJiNjM3YTRhODVjZGIyMmU2OTg3ZWZlMTcyMWUxNTQ3MTgzMDc2MyJ9";

// So'rov uchun yuboriladigan ma'lumotlar (login va parol)
$data = [
    "login" => $login,
    "password" => $password
];

// cURL so'rovini boshlash
$ch = curl_init($url);

// So'rov sozlamalari
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Javobni qaytarish
curl_setopt($ch, CURLOPT_POST, true); // POST metodi
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Ma'lumotlarni yuborish
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Cookie: $cookie",
    "X-XSRF-TOKEN: $x_xsrf_token",
    "X-API-Request: true",
    "Content-Type: application/x-www-form-urlencoded"
]);

// SSL tekshiruvini o'chirish (agar kerak bo'lsa, lekin xavfsizlik uchun tavsiya etilmaydi)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// So'rovni yuborish va javobni olish
$response = curl_exec($ch);

// Xatolikni tekshirish
if (curl_errno($ch)) {
    echo "cURL xatosi: " . curl_error($ch);
} else {
    // Javobni ekranga chiqarish
    echo "API javobi: " . $response;
}

// cURL sessiyasini yopish
curl_close($ch);

?>
