<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420191100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE oauth2_authorization_code (identifier CHAR(80) NOT NULL, client VARCHAR(32) NOT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier VARCHAR(128) DEFAULT NULL, scopes TEXT DEFAULT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_509FEF5FC7440455 ON oauth2_authorization_code (client)');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('CREATE TABLE oauth2_client (identifier VARCHAR(32) NOT NULL, secret VARCHAR(128) DEFAULT NULL, redirect_uris TEXT DEFAULT NULL, grants TEXT DEFAULT NULL, scopes TEXT DEFAULT NULL, active BOOLEAN NOT NULL, allow_plain_text_pkce BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN oauth2_client.redirect_uris IS \'(DC2Type:oauth2_redirect_uri)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_client.grants IS \'(DC2Type:oauth2_grant)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_client.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('CREATE TABLE oauth2_access_token (identifier CHAR(80) NOT NULL, client VARCHAR(32) NOT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier VARCHAR(128) DEFAULT NULL, scopes TEXT DEFAULT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_454D9673C7440455 ON oauth2_access_token (client)');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('CREATE TABLE oauth2_refresh_token (identifier CHAR(80) NOT NULL, access_token CHAR(80) DEFAULT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_4DD90732B6A2DD68 ON oauth2_refresh_token (access_token)');
        $this->addSql('COMMENT ON COLUMN oauth2_refresh_token.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE oauth2_authorization_code ADD CONSTRAINT FK_509FEF5FC7440455 FOREIGN KEY (client) REFERENCES oauth2_client (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth2_access_token ADD CONSTRAINT FK_454D9673C7440455 FOREIGN KEY (client) REFERENCES oauth2_client (identifier) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth2_refresh_token ADD CONSTRAINT FK_4DD90732B6A2DD68 FOREIGN KEY (access_token) REFERENCES oauth2_access_token (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id TYPE INT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE oauth2_authorization_code DROP CONSTRAINT FK_509FEF5FC7440455');
        $this->addSql('ALTER TABLE oauth2_access_token DROP CONSTRAINT FK_454D9673C7440455');
        $this->addSql('ALTER TABLE oauth2_refresh_token DROP CONSTRAINT FK_4DD90732B6A2DD68');
        $this->addSql('DROP TABLE oauth2_authorization_code');
        $this->addSql('DROP TABLE oauth2_client');
        $this->addSql('DROP TABLE oauth2_access_token');
        $this->addSql('DROP TABLE oauth2_refresh_token');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id TYPE INT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id DROP DEFAULT');
    }
}
