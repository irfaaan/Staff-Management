@extends('layouts.admin')
@section('content')
@can('client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.clients.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.client.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Client">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.website') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.skype') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.audio') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.video') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $key => $client)
                        <tr data-entry-id="{{ $client->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $client->id ?? '' }}
                            </td>
                            <td>
                                {{ $client->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $client->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $client->company ?? '' }}
                            </td>
                            <td>
                                {{ $client->email ?? '' }}
                            </td>
                            <td>
                                {{ $client->phone ?? '' }}
                            </td>
                            <td>
                                {{ $client->website ?? '' }}
                            </td>
                            <td>
                                {{ $client->skype ?? '' }}
                            </td>
                            <td>
                                {{ $client->country ?? '' }}
                            </td>
                            <td>
                                {{ $client->status->name ?? '' }}
                            </td>
                            <td>
                                @if($client->audio_url)
                                <button href="#AudioModal"
                                        class="btn btn-sm btn-info"
                                        data-toggle="modal" onclick="playAudio('{{ $client->audio_url}}')">Audio</button>
                                @else
                                    No Audio
                                @endif
                            </td>
                            <td>
                                @if($client->video_url)
                                <button href="#VideoModal"
                                        class="btn btn-sm btn-primary"
                                        data-toggle="modal" onclick="playVideo('{{ $client->video_url}}')">Video</button>
                                @else
                                No Video
                                @endif

                            </td>
                            <td>
                                @can('client_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.clients.show', $client->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('client_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.clients.edit', $client->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('client_delete')
                                    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="VideoModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Play Video</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <video id="VideoPlayer"src="" controls style="width: 100%; height: auto"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div id="AudioModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Play Audio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <audio
                                controls
                                id="AudioPlayer"
                                src=""
                                style="width: 100%;"
                            >
                                Your browser does not support the
                                <code>audio</code> element.
                            </audio>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('client_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clients.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Client:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<script>
    $(document).ready(function() {
        $("#VideoModal").on('hide.bs.modal', function() {
            $("#VideoPlayer").attr('src', '');
        });
        $("#AudioModal").on('hide.bs.modal', function() {
            $("#AudioPlayer").attr('src', '');
        });

    });
    function playVideo(url){
        $("#VideoPlayer").attr('src', url);
    }
    function playAudio(url){
        $("#AudioPlayer").attr('src', url);
    }
</script>

@endsection
