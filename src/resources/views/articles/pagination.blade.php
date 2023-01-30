<div class="pagination mt-3 justify-content-center">
    {{ $articles->appends(request()->input())->links() }}
</div>
