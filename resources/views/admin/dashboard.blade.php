@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:var(--dm-purple-light);color:var(--dm-purple);">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['blogs'] }}</div>
            <div class="dm-stat-label">Total Blogs <span style="color:var(--dm-success);">({{ $stats['blogs_published'] }} published)</span></div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(34,197,94,0.15);color:var(--dm-success);">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['services'] }}</div>
            <div class="dm-stat-label">Total Services <span style="color:var(--dm-success);">({{ $stats['services_homepage'] }} on homepage)</span></div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(245,158,11,0.15);color:var(--dm-warning);">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['newsletters'] }}</div>
            <div class="dm-stat-label">Total Newsletters <span style="color:var(--dm-success);">({{ $stats['newsletters_published'] }} published)</span></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="dm-table-wrap">
            <div class="dm-table-header">
                <div class="dm-table-title">Recent Blogs</div>
                <a href="{{ route('admin.blogs.create') }}" class="dm-btn dm-btn-primary dm-btn-sm">
                    <i class="fa-solid fa-plus"></i> New Blog
                </a>
            </div>
            <table class="dm-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBlogs as $blog)
                    <tr>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" style="color:var(--dm-text);font-weight:500;">
                                {{ Str::limit($blog->title, 40) }}
                            </a>
                        </td>
                        <td>
                            <span class="dm-badge {{ $blog->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </td>
                        <td style="color:var(--dm-text-muted);font-size:13px;">{{ $blog->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:var(--dm-text-muted);">No blogs yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="dm-table-wrap">
            <div class="dm-table-header">
                <div class="dm-table-title">Recent Services</div>
                <a href="{{ route('admin.services.create') }}" class="dm-btn dm-btn-primary dm-btn-sm">
                    <i class="fa-solid fa-plus"></i> New Service
                </a>
            </div>
            <table class="dm-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Homepage</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentServices as $service)
                    <tr>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" style="color:var(--dm-text);font-weight:500;">
                                {{ Str::limit($service->title, 40) }}
                            </a>
                        </td>
                        <td>
                            @if($service->show_on_homepage)
                                <i class="fa-solid fa-check-circle" style="color:var(--dm-success);"></i>
                            @else
                                <i class="fa-solid fa-minus-circle" style="color:var(--dm-text-muted);"></i>
                            @endif
                        </td>
                        <td>
                            <span class="dm-badge {{ $service->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                                {{ ucfirst($service->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:var(--dm-text-muted);">No services yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
