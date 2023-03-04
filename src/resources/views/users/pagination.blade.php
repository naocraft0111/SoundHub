<div class="pagination mt-3 justify-content-center">
    {{ $users->appends(request()->input())->links() }}
</div>
