{$title = 'Delete node'}
{$this->headTitle($title)}
<h1>{$this->escapeHtml($title)}</h1>

<p>Are you sure that you want to delete
    '{$this->escapeHtml($job->jobname)}' by
    '{$this->escapeHtml($job->description)}'?
</p>
{*$url = $this->url['job', ['action' => 'delete'], 'id' => $this->id ]*}
<form action="{*$url*}" method="post">
    <div>
        <input type="hidden" name="id" value="{$job->id|intval}" />
        <input type="submit" name="del" value="Yes" />
        <input type="submit" name="del" value="No" />
    </div>
</form>