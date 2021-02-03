@php
$links = [
    [
        "href" => "admin.dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],
    [
        "href" => [
            [
                "section_text" => "Blog",
                "section_list" => [
                    ["href" => "admin.blog.index", "text" => "Data Blog"],
                    ["href" => "admin.blog.create", "text" => "Buat Blog"]
                ]
            ]
        ],
        "text" => "Blogging",
        "is_multi" => true,
    ],
    [
        "href" => [
            [
                "section_text" => "Berita",
                "section_list" => [
                    ["href" => "admin.news.index", "text" => "Data Berita"],
                    ["href" => "admin.news.create", "text" => "Buat Berita"]
                ]
            ],
            [
                "section_text" => "Event",
                "section_list" => [
                    ["href" => "admin.event.index", "text" => "Data Event"],
                    ["href" => "admin.event.create", "text" => "Buat Event"]
                ]
            ],
            [
                "section_text" => "FAQ",
                "section_list" => [
                    ["href" => "admin.faq.index", "text" => "Data FAQ"],
                    ["href" => "admin.faq.create", "text" => "Buat FAQ"]
                ]
            ],
            [
                "section_text" => "Headline",
                "section_list" => [
                    ["href" => "admin.headline.index", "text" => "Data Headline"],
                    ["href" => "admin.headline.create", "text" => "Buat Headline"]
                ]
            ],
            [
                "section_text" => "Tag",
                "section_list" => [
                    ["href" => "admin.tag.index", "text" => "Data Tag"],
                    ["href" => "admin.tag.create", "text" => "Buat Tag"]
                ]
            ]
        ],

        "text" => "Admin",
        "is_multi" => true,
    ],
    [
        "href" => [
            [
                "section_text" => "User",
                "section_list" => [
                    ["href" => "admin.user.index", "text" => "Data User"],
                    ["href" => "admin.user.create", "text" => "Buat User"]
                ]
            ]
        ],
        "text" => "User",
        "is_multi" => true,
    ],
];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            <li class="menu-header">{{ $link->text }}</li>
            @if (!$link->is_multi)
            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route($link->href) }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @else
                @foreach ($link->href as $section)
                    @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                    @endphp

                    <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chart-bar"></i> <span>{{ $section->section_text }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach ($section->section_list as $child)
                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
        @endforeach
    </aside>
</div>
