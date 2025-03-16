@props(['color' => 'gradient']) <!-- Default qiymat: gradient -->

<div {{ $attributes->merge(['class' => 'logo']) }}>
    <span class="logo-text {{ $color === 'gradient' ? 'logo-text-gradient' : 'logo-text-white' }}">{{ config('app.name') }}</span>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:wght@400;700&display=swap');

    .logo {
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        margin-left: 20px;
    }

    .logo-icon {
        background: linear-gradient(135deg, #2385e8, #1395eb);
        color: white;
        padding: 5px 10px;
        margin-left: 10px;
        border-radius: 6px;
        font-size: 24px;
    }

    .logo-text {
        text-transform: uppercase;
        font-family: "Oswald", serif;
        font-weight: bold;
        font-size: 30px;
    }

    .logo-text-gradient {
        background: linear-gradient(135deg, #2385e8, #1395eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .logo-text-white {
        color: #ffffff;
    }
</style>
