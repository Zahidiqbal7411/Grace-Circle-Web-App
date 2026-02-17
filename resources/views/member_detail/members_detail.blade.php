@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    /* ============================================= */
    /*  GRACE CIRCLE — Premium Member Profile 2026   */
    /* ============================================= */

    :root {
        --mp-primary: #6C63FF;
        --mp-primary-light: #8B85FF;
        --mp-accent: #FF6B6B;
        --mp-text: #1B1D36;
        --mp-text-secondary: #7C8098;
        --mp-text-light: #A8ABBD;
        --mp-bg: #F4F6FB;
        --mp-white: #FFFFFF;
        --mp-radius: 20px;
        --mp-radius-sm: 12px;
    }

    .member-profile-wrapper {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(160deg, #EDE9FE 0%, #F4F6FB 35%, #FEF3F2 70%, #F0FDF4 100%);
        min-height: 100vh;
        padding-bottom: 80px;
        position: relative;
    }

    /* Mesh Gradient Overlay */
    .member-profile-wrapper::before {
        content: '';
        position: fixed;
        inset: 0;
        background:
            radial-gradient(ellipse at 10% 30%, rgba(108,99,255,0.06) 0%, transparent 50%),
            radial-gradient(ellipse at 90% 20%, rgba(255,107,107,0.05) 0%, transparent 50%),
            radial-gradient(ellipse at 50% 90%, rgba(34,197,94,0.04) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .member-profile-wrapper > * { position: relative; z-index: 1; }

    /* ---- Cover Banner ---- */
    .mp-cover {
        position: relative;
        height: 380px;
        overflow: hidden;
        background: linear-gradient(135deg, #6C63FF, #EC4899);
    }

    .mp-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .mp-cover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.2) 60%, rgba(0,0,0,0.5) 100%);
        z-index: 1;
    }

    /* ---- Hero Card ---- */
    .mp-hero-container {
        max-width: 1140px;
        margin: -80px auto 0;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .mp-hero-inner {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: var(--mp-radius);
        padding: 0 32px 32px;
        box-shadow: 0 16px 40px rgba(0,0,0,0.08);
        display: flex;
        align-items: flex-end;
        gap: 28px;
    }

    .mp-avatar-wrapper {
        position: relative;
        margin-top: -60px;
        flex-shrink: 0;
    }

    .mp-avatar-img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--mp-white);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        background: #f0f0f0;
    }

    .mp-hero-info { flex: 1; padding-bottom: 8px; }

    .mp-hero-info h1 {
        font-size: 32px;
        font-weight: 900;
        color: var(--mp-text);
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
    }

    .mp-meta-row {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .mp-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--mp-text-secondary);
        background: rgba(108,99,255,0.06);
        padding: 6px 14px;
        border-radius: 30px;
    }

    .mp-meta-item i { color: var(--mp-primary); font-size: 14px; }

    /* ---- Action Buttons ---- */
    .mp-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 8px;
    }

    .mp-btn {
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
    }

    .mp-btn-primary {
        background: linear-gradient(135deg, var(--mp-primary), var(--mp-primary-light));
        color: #fff;
        box-shadow: 0 4px 15px rgba(108,99,255,0.3);
    }

    .mp-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108,99,255,0.4);
        color: #fff;
    }

    .mp-btn-outline {
        background: rgba(255,255,255,0.8);
        border: 1.5px solid rgba(108,99,255,0.2);
        color: var(--mp-primary);
    }

    .mp-btn-outline:hover {
        background: var(--mp-primary);
        color: #fff;
        border-color: var(--mp-primary);
        transform: translateY(-2px);
    }

    .mp-btn-danger {
        background: rgba(255,107,107,0.1);
        color: var(--mp-accent);
        border: 1.5px solid rgba(255,107,107,0.2);
    }

    .mp-btn-danger:hover {
        background: var(--mp-accent);
        color: #fff;
        border-color: var(--mp-accent);
    }

    /* ---- Content Grid ---- */
    .mp-content-grid {
        max-width: 1140px;
        margin: 30px auto 0;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 28px;
    }

    /* ---- Cards ---- */
    .mp-card {
        background: rgba(255,255,255,0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: var(--mp-radius);
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        margin-bottom: 24px;
    }

    .mp-card-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--mp-text);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(108,99,255,0.1);
    }

    .mp-card-title i {
        width: 36px;
        height: 36px;
        background: rgba(108,99,255,0.1);
        color: var(--mp-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    /* ---- Profile Info Lists ---- */
    .mp-info-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .mp-info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .mp-info-label {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--mp-text-light);
    }

    .mp-info-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--mp-text);
        padding: 8px 0;
    }

    /* ---- Gallery Tiling ---- */
    /* Gallery Styling update */
    .mp-gallery-wrapper {
        max-height: 480px;
        overflow-y: auto;
        padding-right: 8px;
    }

    /* Premium Scrollbar */
    .mp-gallery-wrapper::-webkit-scrollbar {
        width: 6px;
    }
    .mp-gallery-wrapper::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.03);
        border-radius: 10px;
    }
    .mp-gallery-wrapper::-webkit-scrollbar-thumb {
        background: rgba(108,99,255,0.2);
        border-radius: 10px;
        transition: 0.3s;
    }
    .mp-gallery-wrapper::-webkit-scrollbar-thumb:hover {
        background: rgba(108,99,255,0.4);
    }

    .mp-gallery-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .mp-gallery-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }

    .mp-gallery-item:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }

    .mp-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mp-gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.2);
        opacity: 0;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mp-gallery-item:hover .mp-gallery-overlay { opacity: 1; }
    .mp-gallery-overlay i { color: #fff; font-size: 20px; }

    /* ---- About Section ---- */
    .mp-about-text {
        font-size: 15px;
        line-height: 1.7;
        color: var(--mp-text-secondary);
        white-space: pre-wrap;
    }

    /* ---- Responsive ---- */
    @media (max-width: 992px) {
        .mp-hero-inner { flex-direction: column; align-items: center; text-align: center; padding-top: 0; }
        .mp-avatar-wrapper { margin-top: -60px; }
        .mp-meta-row { justify-content: center; }
        .mp-actions { justify-content: center; margin-top: 15px; }
        .mp-content-grid { grid-template-columns: 1fr; }
        .mp-cover { height: 280px; }
    }

    @media (max-width: 576px) {
        .mp-info-list { grid-template-columns: 1fr; }
        .mp-hero-info h1 { font-size: 26px; }
        .mp-card { padding: 20px; }
        .mp-meta-item { padding: 4px 10px; font-size: 12px; }
    }
</style>
@endsection

@section('content')
@php
    $newProfileImage = $user->images->where('image_type', 'profile')->first();
    $profileImg = $newProfileImage 
        ? asset($newProfileImage->image_link) 
        : ($user->galleries->where('image_type', 'profile')->first() 
            ? asset($user->galleries->where('image_type', 'profile')->first()->image_path) 
            : asset('img/photo/photo-1.jpg'));

    $newCoverImage = $user->images->where('image_type', 'cover')->first();
    $coverImg = $newCoverImage 
        ? asset($newCoverImage->image_link) 
        : ($user->galleries->where('image_type', 'cover')->first() 
            ? asset($user->galleries->where('image_type', 'cover')->first()->image_path) 
            : asset('img/videoera-bg.jpg'));

    // Combined gallery logic: include profile, cover, random, AND legacy gallery types
    $galleryImgs = $user->images->whereIn('image_type', ['profile', 'cover', 'random', 'gallery']);
    
    // If empty, fallback to legacy galleries table
    if($galleryImgs->isEmpty()) {
        $galleryImgs = $user->galleries;
    }
@endphp

<div class="member-profile-wrapper">
    
    {{-- Cover Section --}}
    <section class="mp-cover">
        <img src="{{ $coverImg }}" alt="Cover" class="mp-cover-img">
        <div class="mp-cover-overlay"></div>
    </section>

    {{-- Hero Section --}}
    <div class="mp-hero-container">
        <div class="mp-hero-inner">
            <div class="mp-avatar-wrapper">
                <img src="{{ $profileImg }}" alt="{{ $user->name }}" class="mp-avatar-img">
            </div>
            
            <div class="mp-hero-info">
                <h1>{{ $user->name }}</h1>
                <div class="mp-meta-row">
                    <div class="mp-meta-item">
                        <i class="fa fa-user"></i>
                        {{ $user->age }} years old
                    </div>
                    @if($user->country || $user->city)
                    <div class="mp-meta-item">
                        <i class="fa fa-map-marker"></i>
                        {{ $user->country }}{{ $user->city ? ', '.$user->city : '' }}
                    </div>
                    @endif
                    <div class="mp-meta-item">
                        <i class="fa fa-{{ strtolower($user->gender) == 'male' ? 'mars' : 'venus' }}"></i>
                        {{ ucfirst($user->gender) }}
                    </div>
                    @if($blockedByMe)
                    <div class="mp-meta-item" style="background: rgba(255, 107, 107, 0.1); color: #FF6B6B;">
                        <i class="fa fa-ban" style="color: #FF6B6B;"></i>
                        Blocked by you
                    </div>
                    @endif
                    @if($blockedByThem)
                    <div class="mp-meta-item" style="background: rgba(255, 107, 107, 0.1); color: #FF6B6B;">
                        <i class="fa fa-exclamation-triangle" style="color: #FF6B6B;"></i>
                        You are Blocked
                    </div>
                    @endif
                </div>
            </div>

            <div class="mp-actions">
                @php
                    use App\Models\Friend;
                    $authId = Auth::id();
                    $userId = $user->id;

                    $requestSent = Friend::where('request_from', $authId)->where('request_to', $userId)->where('accept', 0)->first();
                    $requestReceived = Friend::where('request_from', $userId)->where('request_to', $authId)->where('accept', 0)->first();
                    $isFriend = Friend::where('accept', 1)
                        ->where(function ($query) use ($authId, $userId) {
                            $query->where(function ($q) use ($authId, $userId) { $q->where('request_from', $authId)->where('request_to', $userId); })
                                  ->orWhere(function ($q) use ($authId, $userId) { $q->where('request_from', $userId)->where('request_to', $authId); });
                        })->first();
                @endphp

                @if ($blockedByMe)
                    <a href="{{ route('user.unblock', $user->id) }}" class="mp-btn mp-btn-outline">
                        <i class="fa fa-unlock"></i> Unblock
                    </a>
                    <a href="{{ route('add.friend', $user->id) }}" class="mp-btn mp-btn-primary">
                        <i class="fa fa-user-plus"></i> Add Friend
                    </a>
                @elseif ($blockedByThem)
                    {{-- Don't show any actions if they blocked me --}}
                @elseif ($isFriend)
                    <a href="{{ route('chat') }}" class="mp-btn mp-btn-primary">
                        <i class="fa fa-comments"></i> Chat Now
                    </a>
                    <a href="{{ route('user.block', $user->id) }}" class="mp-btn mp-btn-danger">
                        <i class="fa fa-ban"></i> Block
                    </a>
                @elseif ($requestSent)
                    <a href="{{ route('cancel.request', ['id' => $requestSent->id, 'user_id' => $user->id]) }}" class="mp-btn mp-btn-danger">
                        <i class="fa fa-times"></i> Cancel Request
                    </a>
                    <a href="{{ route('user.block', $user->id) }}" class="mp-btn mp-btn-danger">
                        <i class="fa fa-ban"></i> Block
                    </a>
                @elseif ($requestReceived)
                    <a href="{{ route('accept.request', ['id' => $requestReceived->id, 'user_id' => $user->id]) }}" class="mp-btn mp-btn-primary">
                        <i class="fa fa-check"></i> Accept Match
                    </a>
                    <a href="{{ route('cancel.request', ['id' => $requestReceived->id, 'user_id' => $user->id]) }}" class="mp-btn mp-btn-outline">
                        <i class="fa fa-trash"></i> Reject
                    </a>
                    <a href="{{ route('user.block', $user->id) }}" class="mp-btn mp-btn-danger">
                        <i class="fa fa-ban"></i> Block
                    </a>
                @else
                    <a href="{{ route('add.friend', $user->id) }}" class="mp-btn mp-btn-primary">
                        <i class="fa fa-user-plus"></i> Add Friend
                    </a>
                    <a href="{{ route('user.block', $user->id) }}" class="mp-btn mp-btn-danger">
                        <i class="fa fa-ban"></i> Block
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="mp-content-grid">
        
        <div class="mp-main-col">
            {{-- Basic Info Card --}}
            <div class="mp-card">
                <div class="mp-card-title">
                    <i class="fa fa-info-circle"></i>
                    Basic Information
                </div>
                <div class="mp-info-list">
                    <div class="mp-info-item">
                        <div class="mp-info-label">Full Name</div>
                        <div class="mp-info-value">{{ $user->name }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Relationship Status</div>
                        <div class="mp-info-value">{{ $user->relationship_status }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Country</div>
                        <div class="mp-info-value">{{ $user->country }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">City</div>
                        <div class="mp-info-value">{{ $user->city }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Working As</div>
                        <div class="mp-info-value">{{ $user->work_as }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Education</div>
                        <div class="mp-info-value">{{ $user->education }}</div>
                    </div>
                </div>
            </div>

            {{-- Personal Details Card --}}
            <div class="mp-card">
                <div class="mp-card-title">
                    <i class="fa fa-star"></i>
                    Personal Details
                </div>
                <div class="mp-info-list">
                    <div class="mp-info-item">
                        <div class="mp-info-label">Languages</div>
                        <div class="mp-info-value">{{ $user->languages }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Religion</div>
                        <div class="mp-info-value">{{ $user->religion }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Smoking</div>
                        <div class="mp-info-value">{{ $user->smoking }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Eye Color</div>
                        <div class="mp-info-value">{{ $user->eye_color }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Caste / Tribe</div>
                        <div class="mp-info-value">{{ $user->cast }}</div>
                    </div>
                    <div class="mp-info-item">
                        <div class="mp-info-label">Interests</div>
                        <div class="mp-info-value">{{ $user->interests }}</div>
                    </div>
                </div>
            </div>

            {{-- About Me Card --}}
            @if($user->about_us)
            <div class="mp-card">
                <div class="mp-card-title">
                    <i class="fa fa-quote-left"></i>
                    About {{ explode(' ', $user->name)[0] }}
                </div>
                <div class="mp-about-text">{{ $user->about_us }}</div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="mp-side-col">
            <div class="mp-card" style="position: sticky; top: 20px;">
                <div class="mp-card-title">
                    <i class="fa fa-camera"></i>
                    Photo Gallery
                </div>
                <div class="mp-gallery-wrapper">
                    <div class="mp-gallery-grid">
                        @forelse($galleryImgs->take(20) as $img)
                            <div class="mp-gallery-item" onclick="previewImage('{{ asset($img->image_link ?? $img->image_path) }}')">
                                <img src="{{ asset($img->image_link ?? $img->image_path) }}" alt="Gallery">
                                <div class="mp-gallery-overlay">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                        @empty
                            @for($i=1; $i<=4; $i++)
                            <div class="mp-gallery-item" onclick="previewImage('{{ asset('img/photo/photo-'.$i.'.jpg') }}')">
                                <img src="{{ asset('img/photo/photo-'.$i.'.jpg') }}" alt="Gallery">
                                <div class="mp-gallery-overlay">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            @endfor
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- IMAGE PREVIEW MODAL --}}
<div id="imagePreviewModal" class="image-preview-modal" onclick="closeImagePreview()">
    <button class="image-preview-close"><i class="fa fa-times"></i></button>
    <div class="modal-image-container">
        <img id="previewImage" src="" alt="Preview">
    </div>
</div>

<style>
    /* Preview Modal Styles */
    .image-preview-modal {
        position: fixed;
        inset: 0;
        z-index: 100000;
        background: rgba(0,0,0,0.95);
        backdrop-filter: blur(20px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 40px;
        cursor: zoom-out;
    }
    .image-preview-modal.active { display: flex; }
    
    .modal-image-container {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-preview-modal img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.8);
        animation: mpZoomIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(255,255,255,0.1);
    }

    @keyframes mpZoomIn {
        from { transform: scale(0.7); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .image-preview-close {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 54px;
        height: 54px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50%;
        color: #fff;
        font-size: 22px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100001;
    }
    .image-preview-close:hover { 
        background: #FF6B6B; 
        transform: scale(1.1) rotate(90deg); 
        border-color: transparent;
    }
    
    .mp-gallery-item, .mp-avatar-img, .mp-cover-img {
        cursor: zoom-in !important;
    }
</style>
@endsection

@section('scripts')
<script>
    // Make it global so inline onclick can always find it
    window.previewImage = function(src) {
        if (!src) return;
        const modal = document.getElementById('imagePreviewModal');
        const img = document.getElementById('previewImage');
        
        console.log('Previewing:', src);
        img.src = src;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeImagePreview = function() {
        const modal = document.getElementById('imagePreviewModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    };

    // Close on Escape key
    $(document).keydown(function(e) {
        if (e.keyCode === 27) window.closeImagePreview();
    });

    $(document).ready(function() {
        // Robust binding for all gallery items and their children
        $(document).on('click', '.mp-gallery-item', function(e) {
            e.preventDefault();
            const img = $(this).find('img');
            if (img.length) {
                window.previewImage(img.attr('src'));
            }
        });
        
        // Specifically for profile and cover
        $('.mp-avatar-img, .mp-cover-img').on('click', function() {
            window.previewImage($(this).attr('src'));
        });
    });
</script>
@endsection
