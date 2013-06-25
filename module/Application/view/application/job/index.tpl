<div class="hero-unit">
    <h2>{$this->translate('List of jobs')}</h2>
    <p>
        <a href="{$this->url('job', ['action'=>'add'])}"  class="btn btn-success">
            {$this->translate('Add new job')}
        </a>
    </p>
    <table class="table table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>{$this->translate('Description')}</th>
            <th>{$this->translate('Action')}</th>
            <th>{$this->translate('Default Schedule')}</th>
            <th>{$this->translate('Estimated Duration')}</th>
            <th>{$this->translate('Operation')}</th>
        </tr>
        {foreach $jobs as $job}
        <tr>
            <td>{$this->escapeHtml($job->id)}</td>
            <td>{$this->escapeHtml($job->description)}</td>
            <td>{$this->escapeHtml($job->action)}</td>
            <td>{$this->escapeHtml($job->defaultschedule)}</td>
            <td>{$this->escapeHtml($job->estimatedduration)}</td>
            <td>
                {icon action='edit' title="{$this->translate('Edit')}"
                    href="{$this->url('job', ['action'=>'edit', 'id' => $job->id])}"}
                {icon action='delete' title="{$this->translate('Delete')}"
                    href="{$this->url('job', ['action'=>'delete', 'id' => $job->id])}"}
            </td>
        </tr>
        {foreachelse}
            <tr class="info"><td colspan="6">{$this->translate("Cant't find any job !")}</td></tr>
        {/foreach}
    </table>
</div>