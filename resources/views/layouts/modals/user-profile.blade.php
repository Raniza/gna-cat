<!-- Modal -->
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userProfileModalLabel">User Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="mb-2 col-12"><b>Nik:</b>&nbsp;{{ Auth::user()->nik }}</span>
                    <span class="mb-2 col-12"><b>Name:</b>&nbsp;{{ Auth::user()->name }}</span>
                    <span class="mb-2 col-12"><b>Email:</b>&nbsp; {{ Auth::user()->email }}</span>
                    <span class="mb-2 col-12"><b>Position:</b>&nbsp; {{ Auth::user()->position->name }}</span>
                    <span class="mb-2 col-12"><b>Department:</b>&nbsp; {{ Auth::user()->department->name }}</span>
                    <span class="mb-2 col-12"><b>Section:</b>&nbsp; {{ Auth::user()->section->name }}</span>
                    <span class="mb-2 col-12"><b>Role:</b>&nbsp; {{ Auth::user()->position->isAdmin ? 'Admin' : 'User' }}</span>
                </div>
                {{--
                <div class="row mb-2">
                    <div class="col-6">
                        <span><b>Nik:</b><br> {{ Auth::user()->nik }}</span>
                    </div>
                    <div class="col-6">
                        <span><b>Name:</b><br> {{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <span><b>Email:</b><br> {{ Auth::user()->email }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <span><b>Position:</b>&nbsp; {{ Auth::user()->position->name }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <span><b>Department:</b><br> {{ Auth::user()->department->name }}</span>
                    </div>
                    <div class="col-6">
                        <span><b>Section:</b><br> {{ Auth::user()->section->name }}</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <span><b>Role:</b>&nbsp; {{ Auth::user()->position->isAdmin ? 'Admin' : 'User' }}</span>
                    </div>
                </div>
                --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>