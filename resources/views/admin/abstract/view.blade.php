<div class="row">
  <div class="col-md-6 form-group">
    <strong>Full Name:</strong> {{ $abstract->full_name }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Email:</strong> {{ $abstract->email }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Mobile Number:</strong> {{ $abstract->phone_code }} {{ $abstract->phone }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Author Institution:</strong> {{ $abstract->author_institution }}
  </div>
  <div class="col-md-6 form-group">
    <strong>City:</strong> {{ $abstract->city }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Country Residence:</strong> {{ config('countries')[$abstract->country]['name'] }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Abstract Title:</strong> {{ $abstract->abstract_title }}
  </div>
  <div class="col-md-6 form-group">
    <strong>Category:</strong> {{ $abstract->category }}
  </div>
{{--   <div class="col-md-6 form-group">
    <strong>Statement:</strong> {{ $abstract->purpose_statment }}
  </div> --}}
  <div class="col-md-12 form-group">
    <strong>Purpose Statement:</strong>
    <br>
    {{ $abstract->purpose_statment_text }}
  </div>
  <div class="col-md-12 form-group">
    <strong>Methods:</strong>
    <br>
    {{ $abstract->methods }}
  </div>
  <div class="col-md-12 form-group">
    <strong>Results:</strong>
    <br>
    {{ $abstract->results }}
  </div>
  <div class="col-md-12 form-group">
    <strong>Conclusions:</strong>
    <br>
    {{ $abstract->conclusion }}
  </div>
  <div class="col-md-12 form-group">
    <strong>The submitted abstract has been viewed by all authors and they agree to its content and to its presentation at the educational activity.</strong>
    <br>
    {{ $abstract->question1 }}
    {{-- {{ $abstract->question1 ? "Yes" : "No" }} --}}
  </div>
  <div class="col-md-12 form-group">
    <strong>TThis submission is in accordance with Research and Ethical guidelines in respective countries and has appropriate institutional ethics approval.</strong>
    <br>
    {{ $abstract->question2 }}
    {{-- {{ $abstract->question2 ? "Yes" : "No" }} --}}
  </div>
  <div class="col-md-12 form-group">
    <strong>TAny conflict of interests interfering with this submitted work will be stated during the presentation.</strong>
    <br>
    {{ $abstract->question3 }}
    {{-- {{ $abstract->question3 ? "Yes" : "No" }} --}}
  </div>
  <div class="col-md-12 form-group">
    <strong>The contents of our presentations are ours alone. The educational activity neither endorses nor disclaims the conclusions, interpretations or opinions expressed by the authors and co-authors of this abstract.</strong>
    <br>
    {{ $abstract->question4 }}
    {{-- {{ $abstract->question4 ? "Yes" : "No" }} --}}
  </div>
  <div class="col-md-12 form-group">
    <strong>File</strong>
    <br>
    <a href="{{ url('admin/abstract/' . $abstract->id . '/download') }}" class="btn btn-primary">Download</a>
    {{-- {{ $abstract->question4 ? "Yes" : "No" }} --}}
  </div>
</div>