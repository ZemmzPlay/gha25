@foreach($questions as $question)
<tr class="@if($question->answered) bg-danger @endif question-{{ $question->id }}" id="question-{{ $question->id }}">
  <td class="text-center"><input type="checkbox" class="answer-question" id="{{ $question->id }}" @if($question->answered) checked @endif ></td>
  <td>{{ $question->registration->name ? $question->registration->name : $question->registration->first_name . " " . $question->registration->last_name }} ({{ $question->registration->country }})</td>
  <td>{{ $question->question }}</td>
  <td>{{ $question->created_at->format('H:i') }}</td>
</tr>
@endforeach