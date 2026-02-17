@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    /* ============================================= */
    /*  GRACE CIRCLE — Premium Profile 2026          */
    /* ============================================= */

    :root {
        --p-primary: #6C63FF;
        --p-primary-light: #8B85FF;
        --p-primary-dark: #5A52D5;
        --p-primary-bg: rgba(108, 99, 255, 0.08);
        --p-accent: #FF6B6B;
        --p-accent-soft: rgba(255, 107, 107, 0.1);
        --p-bg: #F4F6FB;
        --p-white: #FFFFFF;
        --p-text: #1B1D36;
        --p-text-secondary: #7C8098;
        --p-text-light: #A8ABBD;
        --p-border: rgba(0, 0, 0, 0.06);
        --p-success: #22C55E;
        --p-radius: 20px;
        --p-radius-sm: 12px;
    }

    body {
        background: var(--p-bg) !important;
    }

    .profile-page-wrapper {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(160deg, #EDE9FE 0%, #F4F6FB 35%, #FEF3F2 70%, #F0FDF4 100%);
        min-height: 100vh;
        padding-bottom: 80px;
        position: relative;
    }

    /* Subtle mesh gradient overlay */
    .profile-page-wrapper::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(108, 99, 255, 0.06) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 20%, rgba(255, 107, 107, 0.05) 0%, transparent 50%),
            radial-gradient(ellipse at 50% 80%, rgba(34, 197, 94, 0.04) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .profile-page-wrapper > * {
        position: relative;
        z-index: 1;
    }

    /* ---- Cover Section ---- */
    .profile-cover-section {
        position: relative;
        width: 100%;
        height: 360px;
        overflow: hidden;
        background: linear-gradient(135deg, #6C63FF, #EC4899, #F97316);
    }

    .profile-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .profile-cover-section:hover .profile-cover-img {
        transform: scale(1.02);
    }

    .profile-cover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.15) 60%, rgba(0,0,0,0.45) 100%);
        z-index: 1;
    }

    /* Cover Edit Button */
    .profile-cover-edit-btn {
        position: absolute;
        bottom: 24px;
        right: 28px;
        z-index: 10;
        background: rgba(255, 255, 255, 0.95);
        color: var(--p-text);
        border: none;
        padding: 12px 26px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.12), 0 0 0 1px rgba(255,255,255,0.8) inset;
    }

    .profile-cover-edit-btn i {
        color: var(--p-primary);
        font-size: 15px;
        transition: color 0.3s;
    }

    .profile-cover-edit-btn:hover {
        background: var(--p-primary);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(108,99,255,0.35);
    }

    .profile-cover-edit-btn:hover i { color: #fff; }

    /* ---- Hero Card ---- */
    .profile-hero-card {
        position: relative;
        z-index: 5;
        margin-top: -75px;
        max-width: 1140px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 20px;
    }

    .profile-hero-inner {
        display: flex;
        align-items: flex-end;
        gap: 28px;
        padding: 0 32px 28px;
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border-radius: var(--p-radius);
        box-shadow:
            0 1px 2px rgba(0,0,0,0.04),
            0 4px 8px rgba(0,0,0,0.04),
            0 16px 32px rgba(0,0,0,0.06);
        border: 1px solid rgba(255, 255, 255, 0.7);
        padding-top: 0;
    }

    .profile-avatar-wrapper {
        position: relative;
        flex-shrink: 0;
        margin-top: -55px;
    }

    .profile-avatar-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--p-white);
        box-shadow: 0 8px 28px rgba(108, 99, 255, 0.2), 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s;
        background: #e8e8f0;
    }

    .profile-avatar-img:hover {
        transform: scale(1.04);
        box-shadow: 0 12px 36px rgba(108, 99, 255, 0.3), 0 4px 12px rgba(0,0,0,0.1);
    }

    .profile-avatar-edit {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, var(--p-primary), var(--p-primary-light));
        border: 3px solid var(--p-white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 14px rgba(108,99,255,0.4);
    }

    .profile-avatar-edit:hover {
        transform: scale(1.15);
        box-shadow: 0 6px 20px rgba(108,99,255,0.5);
    }

    .profile-avatar-edit i { color: #fff; font-size: 13px; }
    .profile-avatar-edit input[type="file"],
    .profile-cover-edit-btn input[type="file"] { display: none; }

    .profile-hero-info {
        padding-bottom: 4px;
    }

    .profile-hero-info h1 {
        color: var(--p-text);
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.3px;
    }

    .profile-meta {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .profile-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--p-text-secondary);
        font-size: 13px;
        font-weight: 600;
        background: rgba(108, 99, 255, 0.06);
        padding: 5px 12px;
        border-radius: 20px;
        transition: background 0.2s;
    }

    .profile-meta-item:hover {
        background: rgba(108, 99, 255, 0.12);
    }

    .profile-meta-item i {
        font-size: 12px;
        color: var(--p-primary);
    }

    .profile-online-dot {
        width: 8px;
        height: 8px;
        background: var(--p-success);
        border-radius: 50%;
        display: inline-block;
        animation: pulseOn 2s infinite;
    }

    @keyframes pulseOn {
        0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.5); }
        50% { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }

    /* ---- Main Content Grid ---- */
    .profile-content-grid {
        max-width: 1140px;
        margin: 28px auto 0;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 370px;
        gap: 24px;
    }

    /* ---- Card Styling ---- */
    .p-card {
        background: rgba(255, 255, 255, 0.55);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: var(--p-radius);
        padding: 30px;
        box-shadow:
            0 1px 2px rgba(0,0,0,0.03),
            0 4px 8px rgba(0,0,0,0.03),
            0 12px 24px rgba(0,0,0,0.04);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .p-card:hover {
        background: rgba(255, 255, 255, 0.7);
        box-shadow:
            0 1px 2px rgba(0,0,0,0.03),
            0 8px 16px rgba(0,0,0,0.05),
            0 20px 40px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }

    .p-card-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--p-text);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 16px;
        border-bottom: none;
        position: relative;
    }

    .p-card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--p-primary), var(--p-accent), transparent);
        border-radius: 2px;
        opacity: 0.5;
    }

    .p-card-title i {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(108,99,255,0.12), rgba(108,99,255,0.04));
        color: var(--p-primary);
        font-size: 15px;
        border-radius: 10px;
    }

    /* ---- Info Grid ---- */
    .profile-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .p-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .p-field label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--p-text-light);
    }

    .p-field input,
    .p-field select,
    .p-field textarea {
        background: rgba(255, 255, 255, 0.7);
        border: 1.5px solid rgba(0,0,0,0.06);
        border-radius: var(--p-radius-sm);
        padding: 12px 16px;
        color: var(--p-text);
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02) inset;
    }

    .p-field input:focus,
    .p-field select:focus,
    .p-field textarea:focus {
        border-color: var(--p-primary);
        box-shadow: 0 0 0 4px var(--p-primary-bg), 0 1px 3px rgba(0,0,0,0.02) inset;
        background: #fff;
    }

    .p-field textarea {
        resize: vertical;
        min-height: 110px;
    }

    .p-field select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237C8098' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .p-field.full-width {
        grid-column: 1 / -1;
    }

    /* ---- Gender Radio ---- */
    .gender-radio-group {
        display: flex;
        gap: 12px;
    }

    .gender-radio-option {
        flex: 1;
        position: relative;
    }

    .gender-radio-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .gender-radio-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 12px 16px;
        background: rgba(255,255,255,0.7);
        border: 1.5px solid rgba(0,0,0,0.06);
        border-radius: var(--p-radius-sm);
        color: var(--p-text-secondary);
        font-weight: 600;
        font-size: 13px;
        text-transform: none;
        letter-spacing: 0;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gender-radio-option label:hover {
        border-color: rgba(108,99,255,0.3);
        background: rgba(108,99,255,0.04);
    }

    .gender-radio-option input[type="radio"]:checked + label {
        background: linear-gradient(135deg, var(--p-primary), var(--p-primary-light));
        border-color: transparent;
        color: #fff;
        box-shadow: 0 6px 16px rgba(108,99,255,0.3);
    }

    /* ---- Photo Gallery ---- */
    .gallery-card-wrapper {
        position: sticky;
        top: 20px;
    }

    .gallery-scrollable {
        max-height: 520px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 6px;
        scrollbar-width: thin;
        scrollbar-color: rgba(108,99,255,0.35) transparent;
    }

    .gallery-scrollable::-webkit-scrollbar { width: 4px; }
    .gallery-scrollable::-webkit-scrollbar-track { background: transparent; }
    .gallery-scrollable::-webkit-scrollbar-thumb {
        background: rgba(108,99,255,0.35);
        border-radius: 10px;
    }

    .gallery-upload-zone {
        border: 2px dashed rgba(108,99,255,0.25);
        border-radius: 16px;
        padding: 28px;
        text-align: center;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(108,99,255,0.03);
        margin-bottom: 16px;
    }

    .gallery-upload-zone:hover {
        border-color: var(--p-primary);
        background: rgba(108,99,255,0.06);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108,99,255,0.08);
    }

    .gallery-upload-zone i {
        font-size: 30px;
        color: var(--p-primary);
        margin-bottom: 8px;
        display: block;
        opacity: 0.8;
    }

    .gallery-upload-zone p {
        color: var(--p-text-secondary);
        font-size: 12px;
        font-weight: 500;
        margin: 0;
    }

    .gallery-upload-zone span { color: var(--p-primary); font-weight: 700; }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .gallery-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .gallery-item:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:hover img {
        transform: scale(1.08);
    }

    .gallery-item-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 35%, rgba(0,0,0,0.6) 100%);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 12px;
    }

    .gallery-item:hover .gallery-item-overlay { opacity: 1; }

    .gallery-delete-btn {
        background: rgba(255,107,107,0.9);
        backdrop-filter: blur(4px);
        border: none;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        color: #fff;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-delete-btn:hover {
        background: #ef4444;
        transform: scale(1.15);
    }

    .gallery-item-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: linear-gradient(135deg, var(--p-primary), var(--p-primary-light));
        color: #fff;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(108,99,255,0.3);
    }

    /* ---- Upload Progress ---- */
    .upload-progress-bar {
        height: 3px;
        background: rgba(108,99,255,0.1);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 12px;
        display: none;
    }

    .upload-progress-bar .bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, var(--p-primary), var(--p-accent));
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    /* ---- Save Toast ---- */
    .save-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99999;
        background: linear-gradient(135deg, #22C55E, #16A34A);
        color: #fff;
        padding: 14px 26px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 8px 24px rgba(34,197,94,0.3);
        transform: translateY(80px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .save-toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    /* ---- Image Preview Modal ---- */
    .image-preview-modal {
        position: fixed;
        inset: 0;
        z-index: 100000;
        background: rgba(0,0,0,0.88);
        backdrop-filter: blur(12px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .image-preview-modal.active { display: flex; }

    .image-preview-modal img {
        max-width: 90%;
        max-height: 85vh;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.4);
        animation: zoomIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes zoomIn {
        from { transform: scale(0.85); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .image-preview-close {
        position: absolute;
        top: 24px;
        right: 24px;
        width: 46px;
        height: 46px;
        background: rgba(255,255,255,0.12);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-preview-close:hover {
        background: var(--p-accent);
        transform: rotate(90deg) scale(1.1);
    }

    /* ---- Responsive ---- */
    @media (max-width: 992px) {
        .profile-content-grid { grid-template-columns: 1fr; }
        .profile-cover-section { height: 260px; }
        .profile-hero-inner {
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 20px 24px;
        }
        .profile-meta { justify-content: center; }
        .profile-avatar-img { width: 120px; height: 120px; }
        .profile-hero-card { margin-top: -65px; }
        .gallery-card-wrapper { position: static; }
        .gallery-scrollable { max-height: none; }
    }

    @media (max-width: 576px) {
        .profile-info-grid { grid-template-columns: 1fr; }
        .profile-hero-info h1 { font-size: 22px; }
        .p-card { padding: 22px; border-radius: 16px; }
        .profile-content-grid { gap: 16px; }
    }
</style>
@endsection



@section('content')
@php
    // New images table
    $profileImg = $user->images->where('image_type', 'profile')->first();
    $coverImg = $user->images->where('image_type', 'cover')->first();
    $randomImages = $user->images->where('image_type', 'random');

    // Fallback to old galleries table
    if (!$profileImg) {
        $oldProfile = $user->galleries->where('image_type', 'profile')->first();
    }
    if (!$coverImg) {
        $oldCover = $user->galleries->where('image_type', 'cover')->first();
    }

    $profileSrc = $profileImg
        ? asset($profileImg->image_link)
        : (isset($oldProfile) && $oldProfile ? asset($oldProfile->image_path) : asset('img/default-avatar.png'));

    $coverSrc = $coverImg
        ? asset($coverImg->image_link)
        : (isset($oldCover) && $oldCover ? asset($oldCover->image_path) : asset('img/videoera-bg.jpg'));
@endphp

<div class="profile-page-wrapper">

    {{-- ========== COVER SECTION ========== --}}
    <section class="profile-cover-section" id="coverSection">
        <img src="{{ $coverSrc }}" alt="Cover Photo" class="profile-cover-img" id="coverImage">
        <div class="profile-cover-overlay"></div>

        @if(auth()->id() == $user->id)
        <div class="profile-cover-edit-btn" onclick="document.getElementById('coverFileInput').click()">
            <i class="fa fa-camera"></i> Change Cover Photo
            <input type="file" id="coverFileInput" accept="image/*">
        </div>
        @endif
    </section>

    {{-- ========== HERO (Avatar + Name) ========== --}}
    <div class="profile-hero-card">
        <div class="profile-hero-inner">
            <div class="profile-avatar-wrapper">
                <img src="{{ $profileSrc }}" alt="{{ $user->name }}" class="profile-avatar-img" id="profileImage">
                
                @if(auth()->id() == $user->id)
                <div class="profile-avatar-edit" onclick="document.getElementById('profileFileInput').click()">
                    <i class="fa fa-camera"></i>
                    <input type="file" id="profileFileInput" accept="image/*">
                </div>
                @endif
            </div>

            <div class="profile-hero-info">
                <h1 id="heroName">{{ $user->name }}</h1>
                <div class="profile-meta">
                    @if($user->age)
                    <div class="profile-meta-item">
                        <i class="fa fa-birthday-cake"></i>
                        <span id="heroAge">{{ $user->age }} Years</span>
                    </div>
                    @endif
                    <div class="profile-meta-item">
                        <i class="fa fa-map-marker"></i>
                        <span id="heroLocation">{{ $user->country }}{{ $user->city ? ', '.$user->city : '' }}</span>
                    </div>
                    @if($user->isOnline())
                    <div class="profile-meta-item">
                        <span class="profile-online-dot"></span> Online Now
                    </div>
                    @endif
                    @if($user->gender)
                    <div class="profile-meta-item">
                        <i class="fa fa-{{ $user->gender == 'male' ? 'mars' : 'venus' }}"></i>
                        {{ ucfirst($user->gender) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ========== MAIN CONTENT GRID ========== --}}
    <div class="profile-content-grid">

        {{-- ==== LEFT COLUMN ==== --}}
        <div class="profile-left-col">

            {{-- Personal Info --}}
            <div class="p-card" style="margin-bottom: 24px;">
                <div class="p-card-title">
                    <i class="fa fa-user-circle"></i> Personal Information
                </div>
                <form class="profile-info-grid" id="profileForm">
                    <div class="p-field">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" id="field_name">
                    </div>
                    <div class="p-field">
                        <label>Email</label>
                        <input type="email" value="{{ $user->email }}" readonly style="opacity:0.5; cursor:not-allowed;">
                    </div>
                    <div class="p-field full-width">
                        <label>Gender</label>
                        <div class="gender-radio-group">
                            <div class="gender-radio-option">
                                <input type="radio" name="gender" value="male" id="genderMale" {{ $user->gender == 'male' ? 'checked' : '' }}>
                                <label for="genderMale"><i class="fa fa-mars"></i> Male</label>
                            </div>
                            <div class="gender-radio-option">
                                <input type="radio" name="gender" value="female" id="genderFemale" {{ $user->gender == 'female' ? 'checked' : '' }}>
                                <label for="genderFemale"><i class="fa fa-venus"></i> Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="p-field">
                        <label>Age</label>
                        <input type="text" name="age" value="{{ $user->age }}" id="field_age">
                    </div>
                    <div class="p-field">
                        <label>Birthday</label>
                        <div class="input-group date" id="birthday-wrapper-edit" style="display: table; width: 100%;">
                            <input type="text" class="form-control" id="field_birthday" name="birthday"
                                value="{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }}" 
                                readonly style="background: var(--p-bg); border: 1.5px solid var(--p-border); border-radius: 10px; padding: 11px 14px; color: var(--p-text); font-size: 14px; font-weight: 600; cursor: pointer;">
                            <span class="input-group-addon" style="cursor: pointer; background: transparent; border: none; padding: 0 8px; color: var(--p-primary);">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <div class="p-field">
                        <label>Country</label>
                        <input type="text" name="country" value="{{ $user->country }}" id="field_country">
                    </div>
                    <div class="p-field">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $user->city }}" id="field_city">
                    </div>
                    <div class="p-field">
                        <label>Relationship</label>
                        <input type="text" name="relationship_status" value="{{ $user->relationship_status ?: 'Single' }}">
                    </div>
                    <div class="p-field">
                        <label>Looking For</label>
                        <input type="text" name="looking_for" value="{{ $user->gender == 'male' ? 'Female' : 'Male' }}" id="field_looking_for" readonly style="opacity:0.5; cursor:not-allowed;">
                    </div>
                </form>
            </div>

            {{-- Lifestyle & Details --}}
            <div class="p-card" style="margin-bottom: 24px;">
                <div class="p-card-title">
                    <i class="fa fa-briefcase"></i> Lifestyle & Details
                </div>
                <div class="profile-info-grid">
                    <div class="p-field">
                        <label>Work As</label>
                        <input type="text" name="work_as" value="{{ $user->work_as }}">
                    </div>
                    <div class="p-field">
                        <label>Education</label>
                        <input type="text" name="education" value="{{ $user->education }}">
                    </div>
                    <div class="p-field">
                        <label>Languages</label>
                        @php
                            $langs = json_decode($user->languages, true);
                            $langsStr = is_array($langs) ? implode(', ', $langs) : '';
                        @endphp
                        <input type="text" name="languages" value="{{ $langsStr }}">
                    </div>
                    <div class="p-field">
                        <label>Interests</label>
                        <input type="text" name="interests" value="{{ $user->interests }}">
                    </div>
                    <div class="p-field">
                        <label>Smoking</label>
                        <input type="text" name="smoking" value="{{ $user->smoking }}">
                    </div>
                    <div class="p-field">
                        <label>Eye Color</label>
                        <input type="text" name="eye_color" value="{{ $user->eye_color }}">
                    </div>
                    <div class="p-field">
                        <label>Religion</label>
                        <input type="text" name="religion" value="{{ $user->religion ?: 'Islam' }}">
                    </div>
                    <div class="p-field">
                        <label>Caste / Sect</label>
                        <select name="cast">
                            <option value="" disabled {{ !$user->cast ? 'selected' : '' }}>Select your caste/sect</option>
                            @foreach (get_islamic_casts() as $cast)
                                <option value="{{ $cast }}" {{ $user->cast == $cast ? 'selected' : '' }}>{{ $cast }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- About Me --}}
            <div class="p-card">
                <div class="p-card-title">
                    <i class="fa fa-pencil"></i> About Me
                </div>
                <div class="p-field full-width">
                    <textarea name="about_us" placeholder="Tell others about yourself...">{{ $user->about_us }}</textarea>
                </div>
            </div>

        </div>

        {{-- ==== RIGHT COLUMN — Photo Gallery with Scroll ==== --}}
        <div class="profile-right-col">
            <div class="p-card gallery-card-wrapper">
                <div class="p-card-title">
                    <i class="fa fa-image"></i> Photo Gallery
                </div>

                {{-- Scrollable Gallery Container --}}
                <div class="gallery-scrollable">

                    {{-- Upload Zone --}}
                    @if(auth()->id() == $user->id)
                    <div class="gallery-upload-zone" onclick="document.getElementById('randomFileInput').click()">
                        <i class="fa fa-cloud-upload"></i>
                        <p><span>Click to upload</span> a new photo</p>
                        <p style="font-size:10px; margin-top:4px; opacity:0.5;">JPG, PNG, GIF up to 5MB</p>
                        <input type="file" id="randomFileInput" accept="image/*" style="display:none;" multiple>
                    </div>
                    <div class="upload-progress-bar" id="uploadProgressBar">
                        <div class="bar" id="uploadProgressFill"></div>
                    </div>
                    @endif

                    {{-- Gallery Grid --}}
                    <div class="gallery-grid" id="galleryGrid">
                        {{-- Profile thumb --}}
                        <div class="gallery-item" onclick="previewImage('{{ $profileSrc }}')">
                            <img src="{{ $profileSrc }}" alt="Profile">
                            <div class="gallery-item-badge">Profile</div>
                            <div class="gallery-item-overlay"></div>
                        </div>

                        {{-- Cover thumb --}}
                        <div class="gallery-item" onclick="previewImage('{{ $coverSrc }}')">
                            <img src="{{ $coverSrc }}" alt="Cover">
                            <div class="gallery-item-badge">Cover</div>
                            <div class="gallery-item-overlay"></div>
                        </div>

                        {{-- Random images --}}
                        @foreach ($randomImages as $rImg)
                        <div class="gallery-item" id="gallery-item-{{ $rImg->image_id }}" onclick="previewImage('{{ asset($rImg->image_link) }}')">
                            <img src="{{ asset($rImg->image_link) }}" alt="Photo">
                            <div class="gallery-item-overlay">
                                @if(auth()->id() == $user->id)
                                <button class="gallery-delete-btn" onclick="event.stopPropagation(); deleteImage({{ $rImg->image_id }})" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        {{-- Old gallery images fallback --}}
                        @foreach ($user->galleries->where('image_type', 'gallery') as $gImg)
                        <div class="gallery-item" onclick="previewImage('{{ asset($gImg->image_path) }}')">
                            <img src="{{ asset($gImg->image_path) }}" alt="Photo">
                            <div class="gallery-item-overlay"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- Image Preview Modal --}}
<div class="image-preview-modal" id="imagePreviewModal">
    <button class="image-preview-close" onclick="closePreview()"><i class="fa fa-times"></i></button>
    <img src="" alt="Preview" id="previewModalImg">
</div>

{{-- Save Toast --}}
<div class="save-toast" id="saveToast">
    <i class="fa fa-check-circle"></i> <span id="saveToastMsg">Saved!</span>
</div>

@endsection



@section('scripts')
<script>
    // =============================================
    //  IMAGE UPLOADS
    // =============================================
    function uploadImage(file, imageType, callback) {
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('image', file);
        formData.append('image_type', imageType);
        formData.append('user_id', '{{ auth()->id() }}');

        if (imageType === 'random') {
            $('#uploadProgressBar').show();
            $('#uploadProgressFill').css('width', '30%');
        }

        $.ajax({
            url: "{{ route('user.image.store') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && imageType === 'random') {
                        var pct = Math.round((e.loaded / e.total) * 100);
                        $('#uploadProgressFill').css('width', pct + '%');
                    }
                });
                return xhr;
            },
            success: function(response) {
                showSaveToast('Image uploaded successfully!');
                if (callback) callback(response);
                setTimeout(function() {
                    $('#uploadProgressBar').hide();
                    $('#uploadProgressFill').css('width', '0%');
                }, 500);
            },
            error: function(xhr) {
                console.error('Upload error:', xhr.responseText);
                Swal.fire({ icon: 'error', title: 'Upload Failed', text: 'Could not upload image.' });
                $('#uploadProgressBar').hide();
            }
        });
    }

    // Profile Image
    document.getElementById('profileFileInput')?.addEventListener('change', function() {
        if (this.files[0]) {
            uploadImage(this.files[0], 'profile', function(res) {
                document.getElementById('profileImage').src = res.new_image_url;
                document.querySelectorAll('.gallery-item-badge').forEach(function(b) {
                    if (b.textContent.trim() === 'Profile') {
                        b.closest('.gallery-item').querySelector('img').src = res.new_image_url;
                    }
                });
            });
        }
    });

    // Cover Image
    document.getElementById('coverFileInput')?.addEventListener('change', function() {
        if (this.files[0]) {
            uploadImage(this.files[0], 'cover', function(res) {
                document.getElementById('coverImage').src = res.new_image_url;
                document.querySelectorAll('.gallery-item-badge').forEach(function(b) {
                    if (b.textContent.trim() === 'Cover') {
                        b.closest('.gallery-item').querySelector('img').src = res.new_image_url;
                    }
                });
            });
        }
    });

    // Random Images
    document.getElementById('randomFileInput')?.addEventListener('change', function() {
        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            (function(file) {
                uploadImage(file, 'random', function(res) {
                    var grid = document.getElementById('galleryGrid');
                    var div = document.createElement('div');
                    div.className = 'gallery-item';
                    div.setAttribute('onclick', "previewImage('" + res.new_image_url + "')");
                    div.innerHTML = '<img src="' + res.new_image_url + '" alt="Photo"><div class="gallery-item-overlay"><button class="gallery-delete-btn" onclick="event.stopPropagation(); deleteImage(this)" title="Delete"><i class="fa fa-trash"></i></button></div>';
                    grid.appendChild(div);
                });
            })(files[i]);
        }
        this.value = '';
    });


    // =============================================
    //  DELETE IMAGE
    // =============================================
    function deleteImage(idOrBtn) {
        Swal.fire({
            title: 'Delete Photo?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FF6B6B',
            cancelButtonColor: '#6C63FF',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof idOrBtn === 'number') {
                    $.ajax({
                        url: "/profile/image/" + idOrBtn,
                        method: "DELETE",
                        data: { _token: '{{ csrf_token() }}' },
                        success: function() {
                            var el = document.getElementById('gallery-item-' + idOrBtn);
                            if (el) {
                                el.style.transition = 'all 0.4s ease';
                                el.style.transform = 'scale(0)';
                                el.style.opacity = '0';
                                setTimeout(function() { el.remove(); }, 400);
                            }
                            showSaveToast('Photo deleted!');
                        },
                        error: function() {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Could not delete photo.' });
                        }
                    });
                } else {
                    var item = idOrBtn.closest('.gallery-item');
                    if (item) {
                        item.style.transition = 'all 0.4s ease';
                        item.style.transform = 'scale(0)';
                        item.style.opacity = '0';
                        setTimeout(function() { item.remove(); }, 400);
                    }
                }
            }
        });
    }


    // =============================================
    //  IMAGE PREVIEW
    // =============================================
    function previewImage(src) {
        document.getElementById('previewModalImg').src = src;
        document.getElementById('imagePreviewModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePreview() {
        document.getElementById('imagePreviewModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
        if (e.target === this) closePreview();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePreview();
    });


    // =============================================
    //  AUTO-SAVE
    // =============================================
    $(document).ready(function() {

        function autoSave(fieldName, fieldValue) {
            $.ajax({
                url: "{{ route('user.autosave') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    field: fieldName,
                    value: fieldValue
                },
                success: function(response) {
                    showSaveToast(response.message);
                    if (response.data.name) $('#heroName').text(response.data.name);
                    if (response.data.age) $('#heroAge').text(response.data.age + ' Years');
                    if (response.data.country || response.data.city) {
                        var c = response.data.country || '{{ $user->country }}';
                        var ci = response.data.city || '{{ $user->city }}';
                        $('#heroLocation').text(c + (ci ? ', ' + ci : ''));
                    }
                },
                error: function(xhr) { console.log('Error:', xhr.responseText); }
            });
        }

        // Text inputs & textareas
        $('.profile-info-grid input:not([readonly]):not([type="radio"]), .profile-info-grid select, .p-field textarea').on('blur change', function() {
            var fieldName = $(this).attr('name');
            var fieldValue = $(this).val();
            if (!fieldName) return;
            if (fieldName === 'age') {
                fieldValue = fieldValue.replace(/\D/g, '');
                $(this).val(fieldValue);
            }
            autoSave(fieldName, fieldValue);
        });

        // Gender
        $('input[name="gender"]').on('change', function() {
            var gv = $(this).val();
            $('#field_looking_for').val(gv === 'male' ? 'Female' : 'Male');
            autoSave('gender', gv);
            autoSave('looking_for', gv === 'male' ? 'female' : 'male');
        });

        // Cast
        $('select[name="cast"]').on('change', function() {
            autoSave('cast', $(this).val());
        });

        // Birthday
        if (typeof $.fn.datetimepicker !== 'undefined') {
            $('#birthday-wrapper-edit').datetimepicker({
                format: 'DD-MM-YYYY',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            }).on('dp.change', function(ev) {
                var f = ev.date ? ev.date.format('YYYY-MM-DD') : '';
                autoSave('birthday', f);
            });
        }
    });


    // =============================================
    //  SAVE TOAST
    // =============================================
    function showSaveToast(msg) {
        var t = document.getElementById('saveToast');
        document.getElementById('saveToastMsg').textContent = msg || 'Saved!';
        t.classList.add('show');
        setTimeout(function() { t.classList.remove('show'); }, 2500);
    }
</script>
@endsection
