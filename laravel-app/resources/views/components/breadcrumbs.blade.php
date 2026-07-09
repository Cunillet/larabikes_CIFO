<style>
.breadcrumb-item {
    a {
        text-decoration: none;
    }
    + .breadcrumb-item {
        color: #999;
        &::before {
            color: #999; /* Replace with your desired hex code or color name */
        }
    }
}

</style>
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumbs">
    <ol class="breadcrumb rounded px-2 container py-2 my-2">
        <li class="breadcrumb-item">
            <a href="{{ route('welcome') }}">Home</a>
        </li>
        {{ $slot }}
    </ol>
</nav>