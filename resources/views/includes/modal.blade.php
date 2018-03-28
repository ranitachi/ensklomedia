<div id="modal_default" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Information</h5>
			</div>

			<div class="modal-body">
				<p id="content-body"></p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
				<button type="button" class="btn btn-success" id="ok"><i class="fa fa-save"></i>&nbsp;OK</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_ok" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Information</h5>
			</div>

			<div class="modal-body">
				<p id="content-body-ok"></p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="tombol-ok"><i class="fa fa-check"></i>&nbsp;OK</button>
			</div>
		</div>
	</div>
</div>
<div id="modal_video" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Play Video</h5>
			</div>

			<div class="modal-body">
				<p id="content-body-video">
					
				</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" id="tombol-verifikasi"><i class="fa fa-check"></i>&nbsp;Verifikasi</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="tombol-video"><i class="fa fa-check"></i>&nbsp;OK</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-mapping" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Mapping Video</h5>
			</div>

			<div class="modal-body">
				<p id="content-body-mapping">
					<div class="row">
						 <div class="col-lg-3 col-md-3 col-sm-3">&nbsp;</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
								 <div class="search-form">
									<form id="search" action="#" method="post">
										<input type="text" placeholder="Cari Nama atau Email Reviewer" name="reviewer-search" id="search-reviewer" autocomplete="off"/>
										<input type="hidden" id="reviewer_id" value="" name="reviewer_id">
									</form>
								</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3">&nbsp;</div>
					</div>
				</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
				<button type="button" class="btn btn-success" id="ok-mapping"><i class="fa fa-save"></i>&nbsp;OK</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-petamateri" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Form Peta Materi</h5>
			</div>

			<div class="modal-body">
				<p id="content-body-petamateri">
				</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Tutup</button>
				<button type="button" class="btn btn-success" id="ok-petamateri"><i class="fa fa-save"></i>&nbsp;Simpan</button>
			</div>
		</div>
	</div>
</div>