<div class="fixed m-4" x-data="{ isVisible: true }" x-init="setTimeout(() => { isVisible = false; }, 5000)">

    @session('danger-flash')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert" x-show="isVisible">
            {{ session('danger-flash') }}
        </div>
    @endsession

    @session('success-flash')
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert" x-show="isVisible">
            {{ session('success-flash') }}
        </div>
    @endsession
</div>
