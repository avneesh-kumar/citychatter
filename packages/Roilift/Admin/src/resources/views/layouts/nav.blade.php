<div class="bg-blue-600 shadow h-[900px] w-48 text-center p-2">
    <ul class="flex flex-col md:flex-coloum list-none items-left ">
        <li class="nav-item">
            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-50" href="{{ route('admin.category') }}">
                <i class="fa-solid fa-list-ul"></i>&nbsp; Category
            </a>
        </li>
        <li class="nav-item">
            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-50" href="{{ route('admin.post') }}">
                <i class="fa-solid fa-pen-to-square"></i>&nbsp; Post
            </a>
        </li>
        <li class="nav-item">
            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-50" href="{{ route('admin.user') }}">
                <i class="fa-solid fa-user"></i>&nbsp; User
            </a>
        </li>
        <li class="nav-item">
            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-50" href="{{ route('admin.account') }}">
                <i class="fa-solid fa-user-pen"></i>&nbsp; Account
            </a>
        </li>
        <li class="nav-item mt-4 border-t ">
            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-white hover:opacity-50 text-center" href="{{ route('admin.logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>&nbsp; Logout
            </a>
        </li>
    </ul>
</div>
