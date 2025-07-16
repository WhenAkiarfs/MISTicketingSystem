// Finalized submitTicket.js (based on provided design & backend logic)
class IssueManager {
    constructor() {
        this.issueCount = 1;
        this.activeIssue = 0;
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateProgressBar();
        this.attachIssueTypeListeners();

        const firstIssueTypeSelect = document.querySelector('.tab-content.active .issue-type-select');
        if (firstIssueTypeSelect && firstIssueTypeSelect.value) {
            this.handleIssueTypeChange({ target: firstIssueTypeSelect });
        }
    }

    bindEvents() {
        document.getElementById('addIssueBtn').addEventListener('click', () => this.addIssue());
        document.getElementById('mobileIssueSelect').addEventListener('change', (e) => this.switchToIssue(parseInt(e.target.value)));
        document.getElementById('ticketForm').addEventListener('submit', (e) => this.handleSubmit(e));
    }

    addIssue() {
        const newIssueIndex = this.issueCount++;
        this.createTab(newIssueIndex);
        this.createTabContent(newIssueIndex);
        this.updateMobileSelect();
        this.updateIssueCounter();
        this.updateProgressBar();
        this.switchToIssue(newIssueIndex);
        this.attachIssueTypeListeners();
    }

    createTab(index) {
        const tabsContainer = document.getElementById('issueTabs');
        const tab = document.createElement('div');
        tab.className = 'issue-tab';
        tab.setAttribute('data-issue', index);
        tab.innerHTML = `
            Issue #${index + 1}
            <button type="button" class="tab-close"><i class="fa-solid fa-times"></i></button>
        `;
        tab.addEventListener('click', (e) => {
            if (!e.target.classList.contains('tab-close')) this.switchToIssue(index);
        });

        tab.querySelector('.tab-close').addEventListener('click', (e) => {
            e.stopPropagation();
            this.removeIssue(index);
        });

        tabsContainer.appendChild(tab);
        this.updateTabCloseButtons();
    }

    createTabContent(index) {
        const contentsContainer = document.getElementById('tabContents');
        const content = document.createElement('div');
        content.className = 'tab-content';
        content.id = `issue-${index}`;

        let assetField = '';
        if (index === 0) {
            assetField = `
                <div class="form-row-single">
                    <div class="form-group">
                        <label for="asset_${index}">Asset Selection</label>
                        <select name="issues[${index}][asset_id]" id="asset_${index}" class="form-control asset-select" required>
                            <option value="">Select Asset</option>
                            ${assetData.map(asset => `<option value="${asset.AssetId}">${asset.AssetName}</option>`).join('')}
                        </select>
                    </div>
                </div>
            `;
        } else {
            const assetVal = document.querySelector('#asset_0')?.value || '';
            assetField = `<input type="hidden" name="issues[${index}][asset_id]" value="${assetVal}" required>`;
        }

        content.innerHTML = `
            ${assetField}
            <div class="form-row">
                <div class="form-group">
                    <label for="issue_type_${index}">Issue Type</label>
                    <select name="issues[${index}][issue_type_id]" id="issue_type_${index}" class="form-control issue-type-select" required>
                        <option value="">Select Issue Type</option>
                        ${issueTypeData.map(issue => `<option value="${issue.IssueId}">${issue.IssueType}</option>`).join('')}
                    </select>
                </div>

                <div class="form-group">
                    <label for="sub_issue_${index}">Sub-Issue Type</label>
                    <select name="issues[${index}][sub_issue_id]" id="sub_issue_${index}" class="form-control sub-issue-select" required>
                        <option value="">Select Sub-Issue</option>
                    </select>
                </div>
            </div>

            <div class="form-row-single">
                <div class="form-group">
                    <label for="description_${index}">Issue Description</label>
                    <textarea name="issues[${index}][description]" id="description_${index}" class="form-control" 
                            placeholder="Please provide a detailed description of the issue..." required></textarea>
                </div>
            </div>
        `;

        contentsContainer.appendChild(content);

        document.querySelector(`#issue_type_${index}`).addEventListener('change', (e) => {
            const selectedIssueType = e.target.value;
            const subIssueSelect = document.querySelector(`#sub_issue_${index}`);
            subIssueSelect.innerHTML = '<option value="">Select Sub-Issue</option>';

            if (selectedIssueType && subIssueData[selectedIssueType]) {
                subIssueData[selectedIssueType].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.name;
                    subIssueSelect.appendChild(option);
                });
            }
        });
    }

    removeIssue(index) {
        if (this.issueCount <= 1) {
            alert('At least one issue entry is required.');
            return;
        }

        document.querySelector(`[data-issue="${index}"]`)?.remove();
        document.getElementById(`issue-${index}`)?.remove();

        this.issueCount--;
        this.updateIssueCounter();
        this.updateProgressBar();
        this.updateMobileSelect();
        this.updateTabCloseButtons();

        const firstTab = document.querySelector('.issue-tab');
        if (firstTab) this.switchToIssue(parseInt(firstTab.getAttribute('data-issue')));
    }

    switchToIssue(index) {
        document.querySelectorAll('.issue-tab').forEach(tab => tab.classList.remove('active'));
        document.querySelector(`[data-issue="${index}"]`)?.classList.add('active');

        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.getElementById(`issue-${index}`)?.classList.add('active');

        document.getElementById('mobileIssueSelect').value = index;
        this.activeIssue = index;
    }

    updateTabCloseButtons() {
        const tabs = document.querySelectorAll('.issue-tab');
        tabs.forEach(tab => {
            const closeBtn = tab.querySelector('.tab-close');
            closeBtn.style.display = tabs.length > 1 ? 'flex' : 'none';
        });
    }

    updateIssueCounter() {
        document.getElementById('issueCounter').textContent = `${this.issueCount} Issue${this.issueCount > 1 ? 's' : ''}`;
    }

    updateProgressBar() {
        const count = this.getFilledFormsCount();
        const percent = (count / this.issueCount) * 100;
        document.getElementById('progressBar').style.width = `${percent}%`;
    }

    updateMobileSelect() {
        const select = document.getElementById('mobileIssueSelect');
        select.innerHTML = '';
        document.querySelectorAll('.issue-tab').forEach(tab => {
            const i = tab.getAttribute('data-issue');
            select.innerHTML += `<option value="${i}">Issue #${parseInt(i) + 1}</option>`;
        });
        select.value = this.activeIssue;
    }

    getFilledFormsCount() {
        let count = 0;
        document.querySelectorAll('.tab-content').forEach(content => {
            const required = content.querySelectorAll('[required]');
            const filled = [...required].every(input => input.value && input.value.trim() !== '');
            if (filled) count++;
        });
        return count;
    }

    attachIssueTypeListeners() {
        document.querySelectorAll('.issue-type-select').forEach(select => {
            select.removeEventListener('change', this.handleIssueTypeChange);
            select.addEventListener('change', this.handleIssueTypeChange.bind(this));
        });
    }

    handleIssueTypeChange(e) {
        const select = e.target;
        const tab = select.closest('.tab-content');
        const subSelect = tab.querySelector('.sub-issue-select');
        const issueId = select.value;

        subSelect.innerHTML = '<option value="">Select Sub-Issue</option>';
        if (subIssueData[issueId]) {
            subIssueData[issueId].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.textContent = sub.name;
                subSelect.appendChild(opt);
            });
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        const tabs = document.querySelectorAll('.tab-content');
        let allValid = true, firstInvalid = null;

        tabs.forEach((tab, i) => {
            const required = tab.querySelectorAll('[required]');
            const filled = [...required].every(f => f.value && f.value.trim() !== '');
            if (!filled && firstInvalid === null) firstInvalid = i;
            allValid = allValid && filled;
        });

        if (!allValid) {
            alert('Please complete all required fields.');
            this.switchToIssue(firstInvalid);
            return;
        }

        // All validations passed
        document.getElementById('ticketForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', () => new IssueManager());
