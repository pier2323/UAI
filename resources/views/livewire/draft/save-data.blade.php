<div>
  <form wire:submit="submitForm">
    <!-- Form fields here -->

    <button type="submit">Submit</button>
  </form>
  <x-action-message on="formSubmitted"/>
  <x-modal wire:click="hola"></x-modal>


</div>
