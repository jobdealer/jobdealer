<div class="hero-unit">
    <h2>{$this->translate('List of jobs')}</h2>
    <p>
        <a href="{$this->url('job', ['action'=>'add'])}">Add new job</a>
    </p>
    <table class="table">
        <tr>
            <th>#</th>
            <th>{$this->translate('Description')}</th>
            <th>{$this->translate('Action')}</th>
            <th>{$this->translate('Schedule')}</th>
            <th>{$this->translate('Estimated Duration')}</th>
            <th>{$this->translate('Operation')}</th>
        </tr>
        {foreach $jobs as $job}
        <tr>
            <td>{$this->escapeHtml($job->id)}</td>
            <td>{$this->escapeHtml($job->description)}</td>
            <td>{$this->escapeHtml($job->action)}</td>
            <td>{$this->escapeHtml($job->schedule)}</td>
            <td>{$this->escapeHtml($job->estimatedduration)}</td>
            <td>
                <a href="{$this->url('job', ['action'=>'edit', 'id' => $job->id])}">Edit</a>
                <a href="{$this->url('job', ['action'=>'delete', 'id' => $job->id])}">Delete</a>
            </td>
        </tr>
        {/foreach}
    </table>
</div>