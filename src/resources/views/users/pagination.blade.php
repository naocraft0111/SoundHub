<div class="paginate justify-content-center">
    {{ $users->appends(request()->input())->links() }}
</div>
