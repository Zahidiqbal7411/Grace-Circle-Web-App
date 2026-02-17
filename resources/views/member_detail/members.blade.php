@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    /* ============================================= */
    /*  GRACE CIRCLE — Premium Members Page 2026     */
    /* ============================================= */

    :root {
        --m-primary: #6C63FF;
        --m-primary-light: #8B85FF;
        --m-accent: #FF6B6B;
        --m-text: #1B1D36;
        --m-text-secondary: #7C8098;
        --m-text-light: #A8ABBD;
        --m-success: #22C55E;
        --m-bg: #F4F6FB;
        --m-white: #FFFFFF;
        --m-radius: 20px;
    }

    .members-page-wrapper {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(160deg, #EDE9FE 0%, #F4F6FB 35%, #FEF3F2 70%, #F0FDF4 100%);
        min-height: 100vh;
        padding-bottom: 80px;
        position: relative;
    }

    .members-page-wrapper::before {
        content: '';
        position: fixed;
        inset: 0;
        background:
            radial-gradient(ellipse at 15% 40%, rgba(108,99,255,0.07) 0%, transparent 50%),
            radial-gradient(ellipse at 85% 25%, rgba(255,107,107,0.05) 0%, transparent 50%),
            radial-gradient(ellipse at 50% 85%, rgba(34,197,94,0.04) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .members-page-wrapper > * { position: relative; z-index: 1; }

    /* ---- Hero / Banner ---- */
    .members-hero {
        position: relative;
        height: 380px;
        overflow: hidden;
        background: linear-gradient(135deg, #6C63FF, #EC4899, #F97316);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .members-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .members-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(27,29,54,0.4) 0%, rgba(27,29,54,0.7) 100%);
        z-index: 1;
    }

    .members-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 0 20px;
    }

    .members-hero-content h1 {
        color: #fff;
        font-size: 42px;
        font-weight: 900;
        letter-spacing: -0.5px;
        margin: 0 0 6px 0;
        text-shadow: 0 2px 12px rgba(0,0,0,0.2);
    }

    .members-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: rgba(255,255,255,0.7);
    }

    .members-hero-breadcrumb a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: color 0.2s;
    }

    .members-hero-breadcrumb a:hover { color: #fff; }
    .members-hero-breadcrumb span { color: rgba(255,255,255,0.4); }

    /* ---- Search Panel (Glassmorphism) ---- */
    .search-panel {
        position: relative;
        z-index: 10;
        max-width: 1100px;
        margin: -60px auto 0;
        padding: 0 20px;
    }

    .search-panel-inner {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: var(--m-radius);
        padding: 28px 32px;
        box-shadow:
            0 4px 8px rgba(0,0,0,0.04),
            0 16px 40px rgba(0,0,0,0.08);
    }

    .search-row {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .search-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        flex: 1;
        min-width: 120px;
    }

    .search-group label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--m-text-light);
    }

    .search-group input,
    .search-group select {
        background: rgba(255,255,255,0.8);
        border: 1.5px solid rgba(0,0,0,0.06);
        border-radius: 12px;
        padding: 10px 14px;
        color: var(--m-text);
        font-size: 14px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: all 0.3s;
        width: 100%;
    }

    .search-group input:focus,
    .search-group select:focus {
        border-color: var(--m-primary);
        box-shadow: 0 0 0 4px rgba(108,99,255,0.08);
        background: #fff;
    }

    .search-group input::placeholder { color: var(--m-text-light); font-weight: 500; }

    .search-group select {
        appearance: none;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237C8098' stroke-width='2.5'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
    }

    .search-btn {
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--m-primary), var(--m-primary-light));
        color: #fff;
        border: none;
        padding: 12px 32px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 16px rgba(108,99,255,0.3);
        margin-top: 18px;
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(108,99,255,0.4);
    }

    .search-btn i { font-size: 14px; }

    /* ---- Section Title ---- */
    .members-section-title {
        text-align: center;
        margin: 48px 0 32px;
    }

    .members-section-title h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--m-text);
        letter-spacing: -0.3px;
        margin: 0 0 8px 0;
    }

    .members-section-title .title-line {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--m-primary), var(--m-accent));
        border-radius: 4px;
        margin: 0 auto;
    }

    .members-count {
        font-size: 13px;
        color: var(--m-text-secondary);
        font-weight: 500;
        margin-top: 8px;
    }

    /* ---- Members Grid ---- */
    .members-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    /* ---- Member Card ---- */
    .member-card {
        background: rgba(255,255,255,0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        display: block;
        box-shadow:
            0 2px 4px rgba(0,0,0,0.02),
            0 8px 16px rgba(0,0,0,0.04);
    }

    .member-card:hover {
        transform: translateY(-6px);
        box-shadow:
            0 8px 16px rgba(0,0,0,0.06),
            0 20px 48px rgba(108,99,255,0.12);
        background: rgba(255,255,255,0.8);
    }

    .member-card-img-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 4/4.5;
        overflow: hidden;
        background: linear-gradient(135deg, #ede9fe, #fce7f3);
    }

    .member-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .member-card:hover .member-card-img {
        transform: scale(1.06);
    }

    .member-card-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 50%, rgba(27,29,54,0.6) 100%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .member-card:hover .member-card-img-overlay {
        opacity: 1;
    }

    /* Online Badge on image */
    .member-online-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(34,197,94,0.9);
        backdrop-filter: blur(4px);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 4px;
        z-index: 2;
    }

    .member-online-badge .dot {
        width: 6px;
        height: 6px;
        background: #fff;
        border-radius: 50%;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Gender Badge */
    .member-gender-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #fff;
        z-index: 2;
        backdrop-filter: blur(4px);
    }

    .member-gender-badge.female {
        background: rgba(236,72,153,0.85);
    }

    .member-gender-badge.male {
        background: rgba(59,130,246,0.85);
    }

    /* Card Body */
    .member-card-body {
        padding: 16px 18px 20px;
    }

    .member-card-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--m-text);
        margin: 0 0 4px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .member-card-age {
        font-size: 12px;
        font-weight: 600;
        color: var(--m-primary);
        margin: 0 0 8px 0;
    }

    .member-card-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--m-text-secondary);
        font-size: 11px;
        font-weight: 500;
    }

    .member-card-meta i {
        font-size: 11px;
        color: var(--m-primary);
        opacity: 0.7;
    }

    .member-card-footer {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid rgba(0,0,0,0.04);
    }

    .member-card-tag {
        font-size: 10px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        background: rgba(108,99,255,0.06);
        color: var(--m-primary);
    }

    /* View More / Reset Button */
    .members-action-center {
        text-align: center;
        margin-top: 40px;
    }

    .members-view-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(12px);
        border: 1.5px solid rgba(108,99,255,0.2);
        color: var(--m-primary);
        padding: 14px 36px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 16px rgba(108,99,255,0.06);
    }

    .members-view-more-btn:hover {
        background: var(--m-primary);
        color: #fff;
        border-color: var(--m-primary);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(108,99,255,0.3);
        text-decoration: none;
    }

    /* No Results */
    .no-results {
        text-align: center;
        padding: 60px 20px;
        grid-column: 1 / -1;
    }

    .no-results i {
        font-size: 48px;
        color: var(--m-text-light);
        margin-bottom: 16px;
        display: block;
        opacity: 0.5;
    }

    .no-results h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--m-text);
        margin: 0 0 6px 0;
    }

    .no-results p {
        font-size: 14px;
        color: var(--m-text-secondary);
        margin: 0;
    }

    /* ---- Animations ---- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .member-card {
        animation: fadeInUp 0.5s ease forwards;
    }

    .member-card:nth-child(1) { animation-delay: 0.05s; }
    .member-card:nth-child(2) { animation-delay: 0.1s; }
    .member-card:nth-child(3) { animation-delay: 0.15s; }
    .member-card:nth-child(4) { animation-delay: 0.2s; }
    .member-card:nth-child(5) { animation-delay: 0.25s; }
    .member-card:nth-child(6) { animation-delay: 0.3s; }
    .member-card:nth-child(7) { animation-delay: 0.35s; }
    .member-card:nth-child(8) { animation-delay: 0.4s; }

    /* ---- Responsive ---- */
    @media (max-width: 992px) {
        .members-hero { height: 300px; }
        .members-hero-content h1 { font-size: 32px; }
        .search-row { gap: 12px; }
        .members-grid { grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; }
    }

    @media (max-width: 576px) {
        .members-hero { height: 260px; }
        .members-hero-content h1 { font-size: 26px; }
        .search-panel-inner { padding: 20px; }
        .search-row { gap: 10px; }
        .search-group { min-width: 100px; }
        .members-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .member-card-body { padding: 12px 14px 16px; }
    }
</style>
@endsection

@section('content')
<div class="members-page-wrapper">

    {{-- ========== HERO BANNER ========== --}}
    <section class="members-hero">
        <img src="{{ asset('img/member_header.jpeg') }}" alt="Members" class="members-hero-bg">
        <div class="members-hero-overlay"></div>
        <div class="members-hero-content">
            <h1>Find Your Match</h1>
            <div class="members-hero-breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>›</span>
                <a href="#">Community</a>
                <span>›</span>
                <span style="color: rgba(255,255,255,0.9); font-weight: 600;">Members</span>
            </div>
        </div>
    </section>

    {{-- ========== SEARCH PANEL ========== --}}
    <div class="search-panel">
        <div class="search-panel-inner">
            <div class="search-row">
                <div class="search-group">
                    <label>I am a</label>
                    <select id="i_am" name="i_am">
                        <option value="{{ Auth::user()->gender }}">{{ ucfirst(Auth::user()->gender) }}</option>
                    </select>
                </div>

                <div class="search-group">
                    <label>Seeking a</label>
                    <select id="seeking" name="seeking">
                        <option value="female" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Women</option>
                        <option value="male" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Men</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="search-group" style="flex: 0.6;">
                    <label>From Age</label>
                    <input type="number" id="from_age" name="from_age" placeholder="18" min="18">
                </div>

                <div class="search-group" style="flex: 0.6;">
                    <label>To Age</label>
                    <input type="number" id="to_age" name="to_age" placeholder="60" min="18">
                </div>

                <div class="search-group">
                    <label>Country</label>
                    <input type="text" id="country" name="country" placeholder="Any country">
                </div>

                <div class="search-group">
                    <label>City</label>
                    <input type="text" id="city" name="city" placeholder="Any city">
                </div>

                <button type="button" id="searchBtn" class="search-btn">
                    <i class="fa fa-search"></i> Search
                </button>
            </div>
        </div>
    </div>

    {{-- ========== SECTION TITLE ========== --}}
    <div class="members-section-title">
        <h2 id="sectionTitle">All Members</h2>
        <div class="title-line"></div>
        <p class="members-count" id="membersCount">{{ $users->count() }} member{{ $users->count() !== 1 ? 's' : '' }} found</p>
    </div>

    {{-- ========== MEMBERS GRID ========== --}}
    <div class="members-grid" id="serach_members">
        @if ($users->isNotEmpty())
            @foreach ($users as $user)
                @php
                    $blockedByMe = \App\Models\Block::where('block_by', Auth::id())
                        ->where('block_user', $user->id)->exists();
                    $blockedMe = \App\Models\Block::where('block_by', $user->id)
                        ->where('block_user', Auth::id())->exists();

                    $newProfileImage = $user->images->where('image_type', 'profile')->first();
                    $profileImage = $newProfileImage
                        ? asset($newProfileImage->image_link)
                        : ($user->galleries->where('image_type', 'profile')->first()
                            ? asset($user->galleries->where('image_type', 'profile')->first()->image_path)
                            : asset('img/photo/photo-1.jpg'));
                @endphp

                <a href="{{ route('member.details', $user->id) }}" class="member-card">
                    
                    <div class="member-card-img-wrapper">
                        <img src="{{ $profileImage }}" alt="{{ $user->name }}" class="member-card-img">
                        <div class="member-card-img-overlay"></div>

                        @if($user->gender)
                        <div class="member-gender-badge {{ $user->gender }}">
                            <i class="fa fa-{{ $user->gender == 'male' ? 'mars' : 'venus' }}"></i>
                        </div>
                        @endif

                        @if(method_exists($user, 'isOnline') && $user->isOnline())
                        <div class="member-online-badge">
                            <span class="dot"></span> Online
                        </div>
                        @endif
                    </div>

                    <div class="member-card-body">
                        <h4 class="member-card-name">{{ $user->name }}</h4>
                        <p class="member-card-age">{{ $user->age }} years old</p>

                        @if($user->country || $user->city)
                        <div class="member-card-meta">
                            <i class="fa fa-map-marker"></i>
                            <span>{{ $user->country }}{{ $user->city ? ', '.$user->city : '' }}</span>
                        </div>
                        @endif

                        @if($user->work_as || $user->religion)
                        <div class="member-card-footer">
                            @if($user->work_as)
                            <span class="member-card-tag">{{ $user->work_as }}</span>
                            @endif
                            @if($user->religion)
                            <span class="member-card-tag">{{ $user->religion }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <div class="no-results">
                <i class="fa fa-search"></i>
                <h3>No members found</h3>
                <p>Try adjusting your search filters</p>
            </div>
        @endif
    </div>

    {{-- ========== ACTION ========== --}}
    <div class="members-action-center">
        <a href="#" class="members-view-more-btn" id="viewMoreBtn">
            <i class="fa fa-refresh"></i> View More
        </a>
    </div>

</div>

{{-- Block Click Handler --}}
<script>
    function handleBlockedClick(event, blockedByMe, blockedMe, userName, unblockUrl) {
        event.preventDefault();
        if (blockedByMe) {
            Swal.fire({
                icon: 'warning',
                title: 'User Blocked',
                html: 'You have blocked <b>' + userName + '</b>.<br><a href="' + unblockUrl + '" class="btn btn-sm btn-primary mt-2">Click here to unblock</a>',
                showConfirmButton: false,
                allowOutsideClick: true
            });
        } else if (blockedMe) {
            Swal.fire({
                icon: 'error',
                title: 'Access Restricted',
                text: 'This page is restricted or blocked.',
                showConfirmButton: false,
                allowOutsideClick: true
            });
        }
    }
</script>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto-search on change
        $('#i_am, #seeking, #country, #city').on('change input', function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(function() {
                $('#searchBtn').trigger('click');
            }, 500);
        });

        // Search button click
        $('#searchBtn').click(function(e) {
            e.preventDefault();
            
            // Update button to Reset
            $('#viewMoreBtn').text('Reset').attr('href', '{{ route("members") }}');
            
            var i_am = $('#i_am').val();
            var seeking = $('#seeking').val();
            var from_age = $('#from_age').val();
            var to_age = $('#to_age').val();
            var country = $('#country').val();
            var city = $('#city').val();

            // Show loading state
            $('#serach_members').html('<div class="no-results"><i class="fa fa-spinner fa-spin"></i><h3>Searching...</h3><p>Finding your perfect matches</p></div>');
            $('#sectionTitle').text('Search Results');

            $.ajax({
                url: '{{ route("member.search") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    i_am: i_am,
                    seeking: seeking,
                    from_age: from_age,
                    to_age: to_age,
                    country: country,
                    city: city
                },
                success: function(response) {
                    $('#serach_members').html('');
                    $('#membersCount').text(response.length + ' member' + (response.length !== 1 ? 's' : '') + ' found');

                    if (response.length > 0) {
                        response.forEach(function(user, index) {
                            // Profile image logic
                            var profileImage = 'img/photo/photo-1.jpg';
                            if (user.images && user.images.length > 0) {
                                var newImg = user.images.find(img => img.image_type === 'profile');
                                if (newImg) profileImage = newImg.image_link;
                            }
                            if (profileImage === 'img/photo/photo-1.jpg' && user.galleries && user.galleries.length > 0) {
                                var oldImg = user.galleries.find(g => g.image_type === 'profile');
                                if (oldImg) profileImage = oldImg.image_path;
                            }

                            var genderClass = user.gender || '';
                            var genderIcon = user.gender === 'male' ? 'mars' : 'venus';
                            var location = '';
                            if (user.country) location += user.country;
                            if (user.city) location += (location ? ', ' : '') + user.city;

                            var footerTags = '';
                            if (user.work_as) footerTags += '<span class="member-card-tag">' + user.work_as + '</span>';
                            if (user.religion) footerTags += '<span class="member-card-tag">' + user.religion + '</span>';

                            var cardHtml = `
                                <a href="{{ url('/members') }}/${user.id}" class="member-card" style="animation-delay: ${index * 0.05}s">
                                    <div class="member-card-img-wrapper">
                                        <img src="{{ asset('') }}${profileImage}" alt="${user.name}" class="member-card-img">
                                        <div class="member-card-img-overlay"></div>
                                        ${user.gender ? '<div class="member-gender-badge ' + genderClass + '"><i class="fa fa-' + genderIcon + '"></i></div>' : ''}
                                    </div>
                                    <div class="member-card-body">
                                        <h4 class="member-card-name">${user.name}</h4>
                                        <p class="member-card-age">${user.age} years old</p>
                                        ${location ? '<div class="member-card-meta"><i class="fa fa-map-marker"></i><span>' + location + '</span></div>' : ''}
                                        ${footerTags ? '<div class="member-card-footer">' + footerTags + '</div>' : ''}
                                    </div>
                                </a>
                            `;
                            $('#serach_members').append(cardHtml);
                        });
                    } else {
                        $('#serach_members').html(
                            '<div class="no-results"><i class="fa fa-search"></i><h3>No matches found</h3><p>Try broadening your search criteria</p></div>'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $('#serach_members').html(
                        '<div class="no-results"><i class="fa fa-exclamation-circle"></i><h3>Something went wrong</h3><p>Please try again</p></div>'
                    );
                }
            });
        });
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session("success") }}',
        confirmButtonText: 'OK',
        timerProgressBar: true
    });
</script>
@endif
@endsection
